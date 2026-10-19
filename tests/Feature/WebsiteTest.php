<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_public_pages_render(): void
    {
        $post = Post::published()->first();
        $page = Page::first();

        $this->get('/')->assertOk()->assertSee('Berita')->assertSee('Login');
        $this->get('/informasi')->assertOk();
        $this->get('/informasi?q=rapor')->assertOk()->assertSee('Pembagian Rapor');
        $this->get('/informasi?kategori=foto')->assertOk();
        $this->get('/informasi?kategori=video&q=sanggar')->assertOk()->assertSee('Sanggar Noken')->assertDontSee('Pembagian Rapor');
        $this->get('/kategori/foto')->assertRedirect('/informasi?kategori=foto');
        $this->get('/kontak')->assertOk()->assertSee('google.com/maps/embed', false);
        $this->get('/informasi/' . $post->slug)->assertOk()->assertSee($post->title);
        $this->get('/halaman/' . $page->slug)->assertOk()->assertSee($page->title);
        $this->get('/kontak')->assertOk();
        $this->get('/login')->assertOk();
    }

    public function test_draft_and_unpublished_content_is_hidden(): void
    {
        $draft = Post::where('status', 'draft')->first();
        $this->get('/informasi/' . $draft->slug)->assertNotFound();

        $page = Page::first();
        $page->update(['is_published' => false]);
        $this->get('/halaman/' . $page->slug)->assertNotFound();
    }

    public function test_post_with_multiple_categories_appears_in_each(): void
    {
        $post = Post::published()->has('categories', '>=', 2)->with('categories')->first();

        foreach ($post->categories as $category) {
            $this->get('/informasi?kategori=' . $category->slug)->assertSee($post->title);
        }
    }

    public function test_main_navigation_uses_single_informasi_menu(): void
    {
        $html = $this->get('/')->assertOk()->getContent();
        $nav = substr($html, strpos($html, '<header'), strpos($html, '</header>') - strpos($html, '<header'));

        $this->assertStringContainsString('>Informasi</a>', $nav);
        $this->assertStringNotContainsString('kategori=', $nav);
    }

    public function test_map_setting_accepts_iframe_code(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)->put('/admin/pengaturan', [
            'contact_map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18&amp;x=1" width="600" height="450"></iframe>',
        ])->assertSessionHasNoErrors();

        $this->assertSame('https://www.google.com/maps/embed?pb=!1m18&x=1', Setting::get('contact.map_embed'));
    }

    public function test_footer_shows_logged_in_user(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)->get('/')->assertSee($admin->name)->assertSee('Keluar')->assertSee('Dasbor');
    }

    public function test_login_and_inactive_account(): void
    {
        $this->post('/login', ['email' => 'admin@smpn1pirime.sch.id', 'password' => 'password'])
            ->assertRedirect(route('admin.dashboard'));
        $this->post('/logout');

        User::where('role', 'operator')->update(['is_active' => false]);
        $this->post('/login', ['email' => 'operator@smpn1pirime.sch.id', 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_open_every_admin_page(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->actingAs($admin);

        foreach (['/admin', '/admin/posts', '/admin/posts/create', '/admin/categories', '/admin/categories/create',
            '/admin/pages', '/admin/pages/create', '/admin/users', '/admin/users/create', '/admin/pengaturan', '/admin/profil'] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get(route('admin.posts.edit', Post::first()))->assertOk();
        $this->get(route('admin.pages.edit', Page::first()))->assertOk();
        $this->get(route('admin.categories.edit', Category::first()))->assertOk();
        $this->get(route('admin.users.edit', $admin))->assertOk();
    }

    public function test_admin_tables_have_numbering_and_pagination(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::first();

        foreach (range(1, 20) as $i) {
            Post::create(['title' => "Tambahan {$i}", 'status' => 'draft', 'user_id' => $admin->id])
                ->categories()->attach($category);
        }
        $total = Post::count();

        $this->actingAs($admin)->get('/admin/posts?page=2')->assertOk()
            ->assertSee('<td class="td text-slate-500">16</td>', false)
            ->assertSee("dari <span class=\"font-semibold text-slate-700\">{$total}</span> data", false);

        foreach (['/admin/categories', '/admin/pages', '/admin/users'] as $url) {
            $this->get($url)->assertOk()->assertSee('<th class="th w-12">No</th>', false)->assertSee('Menampilkan');
        }
    }

    public function test_operator_permissions(): void
    {
        $operator = User::where('role', 'operator')->first();
        $this->actingAs($operator);

        $this->get('/admin')->assertOk();
        $this->get('/admin/posts')->assertOk();
        foreach (['/admin/categories', '/admin/pages', '/admin/users', '/admin/pengaturan'] as $url) {
            $this->get($url)->assertForbidden();
        }

        $othersPost = Post::where('user_id', '!=', $operator->id)->first();
        $this->get(route('admin.posts.edit', $othersPost))->assertForbidden();
        $this->delete(route('admin.posts.destroy', $othersPost))->assertForbidden();

        $own = Post::where('user_id', $operator->id)->first();
        $this->get(route('admin.posts.edit', $own))->assertOk();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_create_post_with_many_categories(): void
    {
        $operator = User::where('role', 'operator')->first();
        $ids = Category::whereIn('slug', ['berita', 'foto'])->pluck('id')->all();

        $this->actingAs($operator)->post('/admin/posts', [
            'title' => 'Uji Coba Informasi',
            'content' => '<p>Isi <strong>uji</strong></p>',
            'categories' => $ids,
            'status' => 'published',
        ])->assertRedirect(route('admin.posts.index'));

        $post = Post::where('slug', 'uji-coba-informasi')->firstOrFail();
        $this->assertSame($operator->id, $post->user_id);
        $this->assertEqualsCanonicalizing($ids, $post->categories->pluck('id')->all());
        $this->assertNotNull($post->published_at);

        $this->actingAs($operator)->post('/admin/posts', [
            'title' => 'Tanpa Kategori', 'status' => 'draft',
        ])->assertSessionHasErrors('categories');
    }

    public function test_admin_manages_users_and_cannot_delete_self(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->actingAs($admin);

        $this->post('/admin/users', [
            'name' => 'Operator Baru', 'email' => 'baru@example.com', 'role' => 'operator',
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123', 'is_active' => 1,
        ])->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['email' => 'baru@example.com', 'role' => 'operator']);

        $this->delete(route('admin.users.destroy', $admin))->assertSessionHas('error');
        $this->assertModelExists($admin);
    }

    public function test_settings_update_and_maintenance_mode(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)->put('/admin/pengaturan', [
            'site_name' => 'Nama Baru Sekolah',
            'system_maintenance' => 1,
        ])->assertSessionHasNoErrors();

        $this->assertSame('Nama Baru Sekolah', Setting::get('site.name'));

        // Pengunjung melihat halaman perbaikan, pengguna login tetap bisa melihat situs
        $this->get('/')->assertOk()->assertSee('Nama Baru Sekolah');
        auth()->logout();
        $this->get('/')->assertStatus(503);
    }

    public function test_editor_image_upload(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');
        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)
            ->post('/admin/editor/upload', ['file' => \Illuminate\Http\UploadedFile::fake()->image('foto.jpg')])
            ->assertOk()->assertJsonStructure(['location']);

        $this->actingAs($admin)
            ->postJson('/admin/editor/upload', ['file' => \Illuminate\Http\UploadedFile::fake()->create('x.pdf', 10)])
            ->assertStatus(422);
    }

    public function test_thumbnail_fallbacks(): void
    {
        $video = new Post(['content' => '<iframe src="https://www.youtube.com/embed/aqz-KE-bpKQ"></iframe>']);
        $this->assertSame('https://img.youtube.com/vi/aqz-KE-bpKQ/hqdefault.jpg', $video->thumbnail_url);
        $this->assertTrue($video->has_video);

        $img = new Post(['content' => '<p><img src="/storage/a.jpg"></p>']);
        $this->assertSame('/storage/a.jpg', $img->thumbnail_url);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSystemSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SystemSettingsController extends Controller
{
    public function edit()
    {
        $keys = [
            'school.identity.name',
            'school.identity.slogan',
            'school.identity.npsn',
            'school.identity.jenis',
            'school.identity.akreditasi',
            'school.identity.tahun_berdiri',
            'school.contact.email',
            'school.contact.phone',
            'school.contact.address',
            'school.contact.kabupaten',
            'school.contact.jam_operasional',
            'school.social.facebook',
            'school.social.instagram',
            'school.social.youtube',
            'school.social.twitter',
            'school.social.whatsapp',
            'school.assets.logo',
            'school.assets.favicon',
            'school.assets.hero_image',
            'school.hero.title',
            'school.hero.subtitle',
            'school.hero.button_text',
            'school.hero.button_url',
            'school.hero.button_2_text',
            'school.hero.button_2_url',
            'school.hero.tag',
            'school.leadership.vision',
            'school.leadership.mission',
            'school.leadership.goals',
            'school.leadership.motto',
            'school.leadership.head_welcome',
            'school.leadership.head_name',
            'school.leadership.head_nip',
            'school.leadership.head_photo',
            'school.leadership.head_harapan',
            'school.programs',
            'school.statistics.jumlah_siswa',
            'school.statistics.jumlah_guru',
            'school.statistics.jumlah_kelas',
            'school.statistics.jumlah_rombel',
            'school.values',
            'system.maintenance.enabled',
        ];

        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = Setting::get($key);
        }

        return view('admin.system-settings.edit', compact('settings'));
    }

    public function update(UpdateSystemSettingsRequest $request): RedirectResponse
    {
        // Text fields mapping
        $map = [
            'school.identity.name',
            'school.identity.slogan',
            'school.identity.npsn',
            'school.identity.jenis',
            'school.identity.akreditasi',
            'school.identity.tahun_berdiri',
            'school.contact.email',
            'school.contact.phone',
            'school.contact.address',
            'school.contact.kabupaten',
            'school.contact.jam_operasional',
            'school.social.facebook',
            'school.social.instagram',
            'school.social.youtube',
            'school.social.twitter',
            'school.social.whatsapp',
            'school.hero.title',
            'school.hero.subtitle',
            'school.hero.button_text',
            'school.hero.button_url',
            'school.hero.button_2_text',
            'school.hero.button_2_url',
            'school.hero.tag',
            'school.leadership.vision',
            'school.leadership.mission',
            'school.leadership.goals',
            'school.leadership.motto',
            'school.leadership.head_welcome',
            'school.leadership.head_name',
            'school.leadership.head_nip',
            'school.leadership.head_harapan',
            'school.programs',
            'school.statistics.jumlah_siswa',
            'school.statistics.jumlah_guru',
            'school.statistics.jumlah_kelas',
            'school.statistics.jumlah_rombel',
            'school.values',
        ];

        foreach ($map as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // Boolean maintenance
        Setting::set('system.maintenance.enabled', (bool) $request->boolean('system.maintenance.enabled'));

        // Uploads
        $uploads = [
            'school.assets.logo' => ['disk' => 'public', 'dir' => 'admin-assets', 'ext' => 'logo'],
            'school.assets.favicon' => ['disk' => 'public', 'dir' => 'admin-assets', 'ext' => 'favicon'],
            'school.assets.hero_image' => ['disk' => 'public', 'dir' => 'admin-assets', 'ext' => 'hero'],
            'school.leadership.head_photo' => ['disk' => 'public', 'dir' => 'admin-assets', 'ext' => 'head'],
        ];

        foreach ($uploads as $field => $meta) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = Str::slug($meta['ext']) . '-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs($meta['dir'], $filename, $meta['disk']);
                Setting::set($field, $path);
            }
        }

        return redirect()->route('admin.system-settings.edit')->with('success', 'System Settings berhasil diperbarui.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Identitas Sekolah
            'school.identity.name' => 'SMP NEGERI 1 PIRIME',
            'school.identity.npsn' => '40300347',
            'school.identity.jenis' => 'SMP',
            'school.identity.akreditasi' => 'B',
            'school.identity.tahun_berdiri' => '1998',
            'school.identity.slogan' => 'Cerdas, Mandiri, Berkarakter',
            'school.identity.kabupaten' => 'Lanny Jaya',
            'school.identity.provinsi' => 'Papua Pegunungan',

            // Kontak
            'school.contact.email' => 'info@smpn1pirime.sch.id',
            'school.contact.phone' => '+62 821-2044-5529',
            'school.contact.address' => 'Pirime, Lanny Jaya, Papua Pegunungan',

            // Sosial Media
            'school.social.facebook' => 'https://facebook.com/smpn1pirime',
            'school.social.instagram' => 'https://instagram.com/smpn1pirime',
            'school.social.youtube' => 'https://youtube.com/@smpn1pirime',
            'school.social.twitter' => '#',
            'school.social.whatsapp' => '6282120445529',

            // Asset Visual
            'school.assets.logo' => 'images/logo sekolah.png',
            'school.assets.favicon' => null,
            'school.assets.hero_image' => 'images/hero-bg/hero bg (2).png',

            // Hero Section
            'school.hero.title' => 'MEMBANGUN GENERASI <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-blue-400">EMAS LANNY JAYA</span>',
            'school.hero.subtitle' => 'Mewujudkan peserta didik yang Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan demi kemajuan bangsa dan budaya lokal.',
            'school.hero.button_text' => 'Daftar PPDB',
            'school.hero.button_url' => '/register',
            'school.hero.button_2_text' => 'Visi & Misi Kami',
            'school.hero.button_2_url' => '/profil/visi-misi',
            'school.hero.tag' => 'Selamat Datang di Website',

            // Kepemimpinan
            'school.leadership.vision' => 'Mewujudkan peserta didik yang Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan menuju Generasi Emas Lanny Jaya.',
            'school.leadership.mission' => "Menyelenggarakan pembelajaran yang aktif, kreatif, inovatif, dan berbasis kearifan lokal Papua Pegunungan.\nMenanamkan nilai-nilai keimanan, budi pekerti, dan karakter unggul melalui pembiasaan sehari-hari.\nMeningkatkan kompetensi literasi, numerasi, serta teknologi informasi dan komunikasi bagi guru dan peserta didik.\nMengembangkan potensi peserta didik dalam bidang akademik, olahraga, seni, budaya, dan kewirausahaan.\nMewujudkan lingkungan sekolah yang bersih, sehat, aman, nyaman, dan berwawasan lingkungan.\nMenumbuhkan rasa cinta terhadap budaya, adat istiadat, dan kearifan lokal Kabupaten Lanny Jaya.\nMeningkatkan kerja sama antara sekolah, orang tua, gereja, pemerintah, dan masyarakat dalam mendukung pendidikan.",
            'school.leadership.goals' => "Meningkatkan kualitas lulusan sehingga 100% peserta didik dapat menyelesaikan pendidikan dan melanjutkan ke jenjang SMA, SMK, atau MA.\nMembentuk peserta didik yang beriman kepada Tuhan Yang Maha Esa, berakhlak mulia, disiplin, jujur, dan bertanggung jawab.\nMeningkatkan kemampuan literasi, numerasi, dan keterampilan teknologi informasi peserta didik sesuai tuntutan zaman.\nMeningkatkan kompetensi guru dalam menerapkan Kurikulum Merdeka dan pembelajaran yang berpusat pada peserta didik.\nMengembangkan prestasi akademik maupun non-akademik di tingkat distrik, kabupaten, provinsi, dan nasional.\nMenjadikan sekolah sebagai pusat pembinaan generasi muda yang mencintai budaya dan kearifan lokal Lanny Jaya.\nMewujudkan lingkungan sekolah yang bersih, sehat, hijau, aman, dan nyaman.\nMenumbuhkan jiwa kepemimpinan, gotong royong, dan kepedulian sosial.\nMeningkatkan partisipasi orang tua dan masyarakat.\nMempersiapkan generasi muda yang mandiri, berkarakter, dan mampu menghadapi tantangan masa depan.",
            'school.leadership.motto' => 'Cerdas, Mandiri, Berkarakter — SMP Negeri 1 Pirime Jaya',
            'school.leadership.head_welcome' => 'Selamat datang di website resmi SMP Negeri 1 Pirime. Kami berkomitmen untuk terus meningkatkan kualitas pendidikan dan mencetak generasi penerus bangsa yang unggul, berkarakter, serta menjunjung tinggi nilai-nilai budaya lokal.',
            'school.leadership.head_name' => 'Yulianus Giban, S.Pd',
            'school.leadership.head_nip' => '19830512 200903 1 007',
            'school.leadership.head_photo' => 'images/Kepala sekolah.png',
            'school.leadership.head_harapan' => 'Saya berharap SMP Negeri 1 Pirime dapat menjadi sekolah unggulan di Kabupaten Lanny Jaya yang mampu melahirkan generasi muda yang beriman, berilmu, berkarakter, dan peduli lingkungan. Dengan kerja sama seluruh pihak, kita wujudkan Generasi Emas Lanny Jaya.',

            // Program Unggulan
            'school.programs' => "Pirime Literasi Pagi|book-open|15 menit membaca Alkitab dan buku setiap pagi.\nTaman Belajar Kebun Sekolah|leaf|Belajar bercocok tanam sekaligus kewirausahaan.\nSMPN 1 Pirime Berbahasa|language|Pembiasaan Bahasa Indonesia dan Bahasa Lani.\nSanggar Noken & Tifa|palette|Pelestarian budaya Papua.\nPramuka & Bela Negara Pegunungan|shield|Melatih kepemimpinan, disiplin, dan ketahanan.\nDigital Corner 3T|laptop|Belajar komputer dasar, Canva, Microsoft Office, internet, dan TIK.",

            // Statistik Sekolah
            'school.statistics.jumlah_siswa' => '156',
            'school.statistics.jumlah_guru' => '15',
            'school.statistics.jumlah_kelas' => '9',
            'school.statistics.jumlah_rombel' => '9',

            // Nilai Sekolah
            'school.values' => "Beriman|iman|Bertakwa kepada Tuhan Yang Maha Esa sesuai iman Kristen.\nJujur|hand|Mengucapkan dan melakukan kebenaran.\nDisiplin|clock|Taat pada aturan dan tata tertib sekolah.\nGotong Royong|users|Bekerja sama dan saling membantu.\nCinta Budaya|heart|Melestarikan budaya Lanny Jaya.\nPeduli Lingkungan|leaf|Menjaga kebersihan dan kelestarian alam.",

            // PPDB
            'ppdb.online_url' => '#',

            // Sistem
            'system.maintenance.enabled' => false,
        ];

        foreach ($defaults as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => ['value' => $value]]
            );
        }
    }
}


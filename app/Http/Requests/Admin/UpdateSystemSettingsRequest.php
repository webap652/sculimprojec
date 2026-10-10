<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSystemSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            // Identitas Sekolah
            'school.identity.name' => ['nullable', 'string', 'max:120'],
            'school.identity.slogan' => ['nullable', 'string', 'max:180'],

            // Kontak
            'school.contact.email' => ['nullable', 'email', 'max:190'],
            'school.contact.phone' => ['nullable', 'string', 'max:30'],
            'school.contact.address' => ['nullable', 'string', 'max:255'],

            // Sosial Media
            'school.social.facebook' => ['nullable', 'url', 'max:255'],
            'school.social.instagram' => ['nullable', 'url', 'max:255'],
            'school.social.youtube' => ['nullable', 'url', 'max:255'],
            'school.social.twitter' => ['nullable', 'url', 'max:255'],

            // Asset Visual
            'school.assets.logo' => ['nullable', 'image', 'mimes:png,ico,jpg,jpeg,svg', 'max:2048'],
            'school.assets.favicon' => ['nullable', 'image', 'mimes:png,ico,jpg,jpeg,svg', 'max:1024'],
            'school.assets.hero_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],

            // Kepemimpinan
            'school.leadership.vision' => ['nullable', 'string', 'max:1000'],
            'school.leadership.mission' => ['nullable', 'string', 'max:1000'],
            'school.leadership.motto' => ['nullable', 'string', 'max:200'],
            'school.leadership.head_welcome' => ['nullable', 'string', 'max:1500'],
            'school.leadership.head_name' => ['nullable', 'string', 'max:120'],
            'school.leadership.head_photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],

            // Sistem
            'system.maintenance.enabled' => ['nullable', 'boolean'],

            // PPDB/SPMB
            'ppdb_open' => ['nullable', 'boolean'],
            'ppdb_academic_year' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            'ppdb_close_message' => ['required', 'string', 'max:1000'],
            'ppdb_start_date' => ['nullable', 'date'],
            'ppdb_end_date' => ['nullable', 'date', 'after_or_equal:ppdb_start_date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // Checkbox boolean biasanya masuk sebagai 'on' atau null
        $enabled = $this->input('system.maintenance.enabled');
        if ($enabled === 'on') {
            $this->merge(['system.maintenance.enabled' => true]);
        }

        if ($enabled === null) {
            $this->merge(['system.maintenance.enabled' => false]);
        }

        $this->merge(['ppdb_open' => $this->boolean('ppdb_open')]);
    }
}


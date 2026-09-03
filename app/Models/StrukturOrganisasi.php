<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasis';

    protected $fillable = [
        'nama', 'jabatan', 'foto', 'parent_id', 'urutan', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }

    public function children()
    {
        return $this->hasMany(StrukturOrganisasi::class, 'parent_id')->aktif()->urut();
    }

    public function parent()
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'parent_id');
    }

    /**
     * Get the hierarchical tree structure
     */
    public static function tree()
    {
        return static::aktif()->whereNull('parent_id')->with('children.children')->urut()->get();
    }
}


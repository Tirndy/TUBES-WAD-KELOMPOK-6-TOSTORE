<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlamatPengiriman extends Model
{
    protected $table = 'alamat_pengirimans';

    protected $fillable = [
        'user_id',
        'label',
        'nama_penerima',
        'telepon_penerima',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanEkspor extends Model
{
    protected $table = 'permohonan_ekspor';

    protected $fillable = [
        'perusahaan_id',
        'nomor_permohonan',
        'tanggal_permohonan',
        'negara_tujuan',
        'file_permohonan',
        'jumlah_coral',
        'status'
    ];

    // Relasi ke model Perusahaan
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
    

    // Relasi ke DetailPermohonan
    public function detailPermohonan()
    {
        return $this->hasMany(DetailPermohonan::class);
    }
}

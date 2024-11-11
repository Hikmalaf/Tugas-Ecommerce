<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPermohonan extends Model
{
    protected $table = 'detail_permohonan';

    protected $fillable = [
        'permohonan_id',
        'coral_id',
        'jumlah'
    ];

    // Relasi ke model PermohonanEkspor
    public function permohonan()
    {
        return $this->belongsTo(PermohonanEkspor::class, 'permohonan_id');
    }

    // Relasi ke model Coral
    public function coral()
    {
        return $this->belongsTo(Corals::class);
    }
    
}

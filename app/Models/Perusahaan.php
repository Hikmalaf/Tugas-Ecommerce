<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $fillable = [
        'kode_perusahaan',
        'nama_perusahaan',
        'email',
        'nomor_telepon',
        'kontak_person',
        'nomor_telepon_seluler',
        'gambar',
        'alamat',
        'jenis',
        'provinsi',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($perusahaan) {
            if ($perusahaan->password) {
                $perusahaan->password = Pengguna::make($perusahaan->password); // Enkripsi password
            }
        });
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }

    // relasi ke KuotaTahunan
    public function annualQuotas()
    {
        return $this->hasMany(KuotaTahunan::class, 'perusahaan_id');
    }
    // Relasi ke PermohonanEkspor
    public function permohonanEkspor()
    {
        return $this->hasMany(PermohonanEkspor::class);
    }
}





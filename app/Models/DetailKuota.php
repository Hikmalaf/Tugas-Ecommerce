<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKuota extends Model
{
    use HasFactory;

    protected $table = 'quota_details';

    public function index()
{
    // Eager load relasi 'coral' agar data coral dimuat bersama dengan DetailKuota
    $quotaDetails = DetailKuota::with('coral')->get();

    return view('kuota.detailkuota', compact('quotaDetails'));
}


    // Menambahkan atribut yang bisa diisi massal
    protected $fillable = [
        'annual_quota_id',  // Pastikan juga kolom ini ada dalam $fillable
        'karang',            // Ini adalah kolom yang berhubungan dengan relasi 'coral'
        'jumlah_kuota',      // Pastikan juga kolom jumlah_kuota ada di sini
    ];

    // Relasi dengan KuotaTahunan
    public function annualQuota()
    {
        return $this->belongsTo(KuotaTahunan::class, 'annual_quota_id');
    }

    // Relasi dengan Corals
    public function coral()
    {
        return $this->belongsTo(Corals::class, 'karang');
    }
}
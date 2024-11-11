<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DetailKuota extends Model
{
    use HasFactory;

    protected $table = 'quota_details';

    public function index()
{
    // Eager load relasi 'coral' agar data coral dimuat bersama dengan DetailKuota
    $quotaDetails = DetailKuota::with('coral')->get();
    $perusahaanId = DetailKuota::with('perushaan_id')->get();

    return view('asosiasi.kuota.detailkuota', compact('quotaDetails','perusahaan_id'));
}


    // Menambahkan atribut yang bisa diisi massal
    protected $fillable = [
        'annual_quota_id',  
        'karang',            
        'jumlah_kuota',      
        'perusahaan_id',
    ];

    // Relasi dengan KuotaTahunan
    public function annualQuota()
    {
        return $this->belongsTo(KuotaTahunan::class, 'annual_quota_id');
    }

    // Relasi dengan Corals
    public function coral()
    {
        return $this->belongsTo(Corals::class, 'coral_id'); // Pastikan 'coral_id' adalah nama kolom yang sesuai
    }
    
    public function perusahaanId()
    {
      return $this->belongsTo(Perusahaan::class,'perusahaan_id');   
    }
    
}
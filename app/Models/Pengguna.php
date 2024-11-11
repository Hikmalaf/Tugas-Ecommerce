<?php


namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama', 'email', 'password', 'role', 'perusahaan_id'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
    // Di dalam model Pengguna
    public function role()
    {
        return $this->role; // Mengakses role pengguna
    }
    
}

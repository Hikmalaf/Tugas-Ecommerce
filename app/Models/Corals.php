<?php

// Model Corals.php (ganti menjadi Coral jika lebih sesuai dengan konvensi Laravel)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corals extends Model // Perhatikan nama model yang konsisten (Coral bukan Corals)
{
    use HasFactory;

    protected $table = 'corals';
    protected $fillable = [
        'id',
        'nama',
    ];

    public function quotaDetails()
    {
        return $this->hasMany(DetailKuota::class, 'coral_id'); 
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuotaTahunan extends Model
{
    use HasFactory;

    protected $table = 'annual_quota';

    public function quotaDetails()
    {
        return $this->hasMany(DetailKuota::class, 'annual_quota_id');
    }
}

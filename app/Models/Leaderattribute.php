<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderattribute extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "certificatename",
        "orginalcertificatename"
    ];
    protected $attributes = [
        'certificatename' => NULL,
        'orginalcertificatename' => NULL,
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','from');
    }
}

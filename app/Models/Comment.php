<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        "from",
        "reply",
        "travel_id",
        "message",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

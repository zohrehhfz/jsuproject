<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        "from",
        "travel_id",
        "parent_id ",
        "flag",
        "message",
    ];
    protected $attributes = [
        'parent_id' => NULL,
    ];
}

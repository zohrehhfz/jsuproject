<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
	
    use HasFactory;
	protected $table = 'travels';
	protected $fillable = [
        'destination',
         'traveltime',
         'registerationstart',
        'registerationend',
        'description',
		'cancel',
    ];
	
	public function users()
	{
		return $this->belongsToMany('App\Models\User')->withPivot('role')->withTimestamps();
	}	
    public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
	public function chats()
	{
		return $this->hasMany('App\Models\Chat');
	}
}

<?php

namespace App;

use App\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
	use Searchable;

	public function searchableAs()
	{
		return "post";
	}

	public function toSearchableArray()
	{
		return[
			'title'=>$this->title,
			'content'=>$this->content,
		];
	}

	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment')->orderBy('created_at','desc');
	}


	//he yong hu jin xing guan lian
	public function zan($user_id)
	{
		return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
	}


	//wen zhan de suo you zan
	public function zans()
	{
		return $this->hasMany(\App\Zan::class);
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	// use SoftDeletes;

	protected $fillable = [
        'name', 'slug', 'featuredImg','title',
    ];

    public function getFeaturedAttribute($featuredImg)
    {
    	return asset($featuredImg);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)
        ->withTimestamps();
    }
}

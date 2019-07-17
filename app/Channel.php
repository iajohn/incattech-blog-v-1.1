<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name', 'slug','parent_id', 'created_by', 'edited_by', 'display_order'
    ];

    // public function getFeaturedAttribute($featuredImg)
    // {
    // 	return asset($featuredImg);
    // }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class)
        ->withTimestamps();
    }
}

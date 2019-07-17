<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'featuredImg','created_by', 'edited_by',
    ];

    public function getFeaturedAttribute($featuredImg)
    {
    	return asset($featuredImg);
    }

    public function entries()
    {
        return $this->hasMany(PlaylistEntry::class,'playlist_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }


}

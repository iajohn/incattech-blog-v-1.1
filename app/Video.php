<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
     use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'slug', 'featuredImg', 'imgCredit', 'body',
    ];

    public function getFeaturedAttribute($featuredImg)
    {
        return asset($featuredImg);
    }

    protected $date =['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_video', 'video_id', 'user_id')
            ->withPivot('operation_type');
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class)
        ->withTimestamps();
    }

    // public function vtags()
    // {
    //     return $this->belongsToMany(Vtag::class)->withTimestamps();
    // }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}

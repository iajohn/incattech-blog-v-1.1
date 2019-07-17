<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

	protected $fillable = [
        'user_id', 'profile_pics', 'about', 'facebook', 'instagram', 
        'twitter', 'youtube', 'whatsapp', 'ocuppation', 'company',
        'hobbies',
    ];

    protected $date =['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The videos that belong to the user.
     */
    public function seenVideos(){
        return $this->belongsToMany(Video::class, 'user_video', 'user_id', 'video_id')
            ->withPivot('operation_type');
    }
}

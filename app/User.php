<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','firstname','lastname','username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favorite_posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function videos()
    {
        return $this->hasMany(Video::class,'created_by');
    }

    public function favorite_videos()
    {
        return $this->belongsToMany(Video::class)->withTimestamps();
    }

    public function channels(){
        return $this->hasMany(Channel::class, 'created_by');
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class, 'user_id');
    }

    /**
     * The videos that belong to the user.
     */
    public function seenVideos(){
        return $this->belongsToMany(Video::class, 'user_video', 'user_id', 'video_id')
            ->withPivot('operation_type');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeAuthors($query)
    {
        return $query->where('role_id',2);
    }

    public function scopeReaders($query)
    {
        return $query->where('role_id',3);
    }

}

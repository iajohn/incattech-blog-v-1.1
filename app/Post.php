<?php

namespace App;

use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
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
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        
        return $this->belongsToMany(Category::class)
        ->withTimestamps();    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
    
    public function scopeFilter($query, $filters)
    {
        if ($month = $filters['month'] ?? false) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters['year'] ?? false) {
            $query->Year('created_at', Carbon::parse($year)->year);
        }
    }

    // public static function archives($)
    // {
    //     $posts = Post::latest()
    //                  ->approved()
    //                  ->published()
    //                  ->filter(request(['month', 'year']))
    //                  ->get();
    // }
}

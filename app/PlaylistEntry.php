<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistEntry extends Model
{
    public function entries()
    {
        return $this->belongsTo(Playlist::class,'playlist_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vtag extends Model
{
    public function videos()
    {
        return $this->belongsToMany(Video::class)->withTimestamps();
    }
}

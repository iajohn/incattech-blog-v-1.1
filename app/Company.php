<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'number',  'email', 'webmail', 'country', 
        'city', 'street', 'open_days', 'facebook', 'instagram', 
        'twitter', 'whatsapp', 'youtube', 'about_body'
    ];
}

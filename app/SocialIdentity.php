<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Copied from https://www.twilio.com/blog/add-facebook-twitter-github-login-laravel-socialite

class SocialIdentity extends Model
{
    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

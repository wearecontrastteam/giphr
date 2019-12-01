<?php

namespace App\Http\Controllers;

use App\Giph;
use App\Like;
use App\User;
use Cache;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        return view('stats')
            ->withStats([
                'users' => Cache::remember('users_count', now()->addMinute(), function(){ return User::count(); }),
                'giphs' => Cache::remember('giphs_count', now()->addMinute(), function(){ return Giph::count(); }),
                'jay-zs' => Cache::remember('jay-zs_count', now()->addMinute(), function(){ return Giph::whereGiphyId('cYJgsdeB6VThe')->count(); }),
                'likes' => Cache::remember('likes_count', now()->addMinute(), function(){ return Like::count(); }),
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Giph;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('timeline');
    }

}

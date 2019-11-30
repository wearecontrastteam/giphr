<?php

namespace App\Http\Controllers;

use App\Giph;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $giphs = Giph::with(['user','likes.user'])->orderBy('created_at', 'desc')->get();
        $users = User::all();

        return view('home', [
            'users' => $users,
            'giphs' => $giphs,
        ]);
    }

    public function post(Request $request)
    {
        $user = auth()->user();
        $user->giphs()->create([
            'giphy_id' => $request->get('giphy_id'),
        ]);

        return "OK";
    }

    public function like(Giph $giph)
    {
        $user = auth()->user();

        $user->likes()->create([
            'giph_id' => $giph->id,
            'giphy_id' => 'some_like_gif',
        ]);

        return "OK";
    }
}

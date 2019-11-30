<?php

namespace App\Http\Controllers;

use App\Post;
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
        $posts = Post::with(['user','likes.user'])->orderBy('created_at', 'desc')->get();
        $users = User::all();

        return view('home', [
            'users' => $users,
            'posts' => $posts,
        ]);
    }

    public function post(Request $request)
    {
        $user = auth()->user();
        $user->posts()->create([
            'giphy_id' => $request->get('giphy_id'),
        ]);

        return "OK";
    }

    public function like(Post $post)
    {
        $user = auth()->user();

        $user->likes()->create([
            'post_id' => $post->id,
            'giphy_id' => 'some_like_gif',
        ]);

        return "OK";
    }
}

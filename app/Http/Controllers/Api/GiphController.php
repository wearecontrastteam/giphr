<?php

namespace App\Http\Controllers\Api;

use App\Giph;
use App\Http\Controllers\Controller;
use App\Http\Resources\Giph as GiphResource;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return GiphResource::collection(Giph::with('user')->latest()->paginate());
    }

    public function show(Giph $giph)
    {
        $giph->load([
            'user',
            'likes.user'
        ]);
        return new GiphResource($giph);
    }

    public function postGiph(Request $request)
    {
        // For manual testing with Postman
        //Auth::login(User::find(2));

        $user = auth()->user();
        $user->giphs()->create([
            'giphy_id' => $request->get('giphy_id'),
        ]);

        return ['status' => 'ok'];
    }

    public function like(Giph $giph)
    {
        // For manual testing with Postman
        //Auth::login(User::find(2)); // TEMP

        $user = auth()->user();
        Like::updateOrCreate([
            'user_id' => $user->id,
            'giph_id' => $giph->id,
        ], [
            'giphy_id' => 'some_like_gif'
        ]);

        return ['status' => 'ok'];
    }
}

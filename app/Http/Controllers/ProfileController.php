<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->avatar_giphy_id = $request->get('avatar_giphy_id');
        $user->name = $request->get('name');
        $user->save();

        return redirect()->route('profile.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show( User $user )
    {
        $user->loadCount('giphs');
        return view('profile.show')
            ->withUser($user);
    }

    public function edit()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $firstTimeProfileUpdate = false;
        if($user->avatar_giphy_id === null){
            $firstTimeProfileUpdate = true;
        }

        $user->avatar_giphy_id = $request->get('avatar_giphy_id');
        $user->name = $request->get('name');
        $user->save();

        return $firstTimeProfileUpdate
            ? redirect()->route('timeline')
            : redirect()->route('profile.show', $user);
    }
}

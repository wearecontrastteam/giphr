<?php

namespace App\Http\Controllers\Api;

use App\Giph;
use App\Http\Controllers\Controller;
use App\Http\Resources\Giph as GiphResource;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function giphs( User $user )
    {
        return GiphResource::collection(
            Giph::whereUserId($user->id)
                ->with(['user', 'likes.user'])
                ->paginate(20)
        );
    }
}

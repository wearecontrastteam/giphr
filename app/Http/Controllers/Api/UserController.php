<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    public function show(User $user)
    {
        $user->load('giphs');
        return new UserResource($user);
    }
}

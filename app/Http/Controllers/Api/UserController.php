<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $user = User::first();

        return new UserResource($user);
        // return $user;
    }

    public function users(Request $request)
    {
        $users = User::all();

        return new UserResourceCollection($users);
        // return $users;
    }
}

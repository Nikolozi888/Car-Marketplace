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
        $user = User::find(2);

        return new UserResource($user);
        // return $user;
    }

    public function users(Request $request)
    {
        $users = User::with('cars')->paginate(3);

        return (new UserResourceCollection($users->keyBy('id')))
                                ->additional([
                                    'meta' => [
                                        'a' => 1
                                    ]
                                ]);
        // return $users;
    }
}

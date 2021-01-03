<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

/**
 * Class UserController.
 */
class UserController extends Controller
{

    public function getAll(Request $request)
    {
        return UserResource::collection(User::where('id', '<>', $request->user()->id)->get());
    }
}

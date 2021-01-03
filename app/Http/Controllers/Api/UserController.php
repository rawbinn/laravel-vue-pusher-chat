<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * List of all users except auth user
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @author Rawbinn Shrestha ( rawbinnn@gmail.com )
     */
    public function getAll(Request $request)
    {
        return UserResource::collection(User::where('id', '<>', $request->user()->id)->get());
    }
}

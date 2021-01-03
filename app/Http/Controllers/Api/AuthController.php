<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Rawbinn Shrestha ( rawbinnn@gmail.com )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth('api')->attempt($credentials)) {
            return response()->json([
                'token' => $token,
                'user' => new UserResource(auth('api')->user())
            ], Response::HTTP_OK);
        }

        return response()->json(['status' => true, 'message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Logout auth user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Rawbinn Shrestha ( rawbinnn@gmail.com )
     */
    public function logout(Request $request)
    {
        auth('api')->logout();

        return response()->json(['status' => true, 'message' => 'Logged out successfully', 'data' => []], Response::HTTP_OK);
    }

    /**
     * Register user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Rawbinn Shrestha ( rawbinnn@gmail.com )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['status' => false, 'message' => $errors[0], 'data' => []], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Account registerd successfully.',
            'data' => new UserResource($user)
            ], Response::HTTP_CREATED);

    }
}

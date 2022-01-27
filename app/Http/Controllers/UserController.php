<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = User::create($request->only([
            'name',
            'email',
            'password'
        ]));

        return response()->json([
            $user->name
        ], Response::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            return response()->json([
                'token' => $user->createToken( $user->id . $request->userAgent() )->plainTextToken
            ], Response::HTTP_OK);
        }

        return response()->json([
            'Invalid credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }
}

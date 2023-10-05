<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request) {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $token = $user->createToken('admin')->plainTextToken;

            return [
                'token' => $token
            ];
        }

        return response([
            'error' => 'Invalid Credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function register(RegisterRequest $request) {
        $validated = $request->validated();
        if ($validated['password'] !== $validated['password_confirm']) {
            return response([
                'error' => "Password and Password Confirm doesn't match"
            ], Response::HTTP_BAD_REQUEST);
        }
        $user = User::create($validated);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }
}

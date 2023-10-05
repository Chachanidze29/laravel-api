<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function user(Request $request) {
        return new UserResource(auth()->user());
    }

    public function index(Request $request) {
        return UserResource::collection(User::all());
    }

    public function show(Request $request, User $user) {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request) {
        $validated = $request->validated();
        $user = User::create($validated);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, User $user) {
        $validated = $request->validated();

        $user->update($validated);

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function destroy(Request $request, User $user) {
        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

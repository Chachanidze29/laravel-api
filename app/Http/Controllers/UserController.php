<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(Request $request) {
        return User::all();
    }

    public function show(Request $request, User $user) {
        return $user;
    }

    public function store(StoreUserRequest $request) {
        $validated = $request->validated();
        $user = User::create($validated);

        return response($user, Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, User $user) {
        $validated = $request->validated();

        $user->update($validated);

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy(Request $request, User $user) {
        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

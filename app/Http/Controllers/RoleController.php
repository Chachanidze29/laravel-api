<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index(Request $request) {
        return Role::paginate();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'string|max:255'
        ]);

        $role = Role::create($validated);

        return response($role, Response::HTTP_CREATED);
    }

    public function show(Request $request, Role $role) {
        return $role;
    }

    public function update(Request $request, Role $role) {
        $role->update($request->only('name'));

        return response($role, Response::HTTP_ACCEPTED);
    }

    public function destroy(Request $request, Role $role) {
        $role->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('roles.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $current_permissions = json_decode($role->permissions()->pluck('id'), true);
        $permissions = Permission::all();
        return view('roles.form', compact('role', 'permissions', 'current_permissions'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $role = Role::findOrFail($id);
        $role->syncPermissions(array_keys($requestData['permissions'] ?? []));
        return to_route('roles.index')->with('success', 'Permissions Updated Successfully');
    }
}

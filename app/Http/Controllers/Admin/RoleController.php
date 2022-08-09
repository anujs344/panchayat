<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index()
    {
        $roles = Role::where('name', '!=', 'user')->get();
        $permissions = Permission::all();
        return view('admin_dashboard.role.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin_dashboard.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $permissions = $request->input('permissions');
        
        $save = Role::create([
            'name' => strtolower($request->input('name')),
        ]);

        if ($save) {
            $save->permissions()->attach($permissions);
            return redirect()->route('admin.role.view')->with('success', 'Role successfully created');
        } else {
            return redirect()->route('admin.role.view')->with('error', 'Role not created');
        }
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin_dashboard.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $permissions = $request->input('permissions');

        if ($role->id == 1 || $role->id ==2) {
            return redirect()->route('admin.role.view')->with('error', 'You are not allowed to update this role');
        }
        $role->name = strtolower($request->input('name'));

        if ($role->save()) {
            $role->permissions()->sync($permissions);
            return redirect()->route('admin.role.view')->with('success', 'Role successfully updated');
        } else {
            return redirect()->route('admin.role.view')->with('error', 'Role not updated');
        }
    }

    public function destroy(Role $role)
    {
        //
    }
}

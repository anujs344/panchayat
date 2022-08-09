<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    public function admin()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('administrator', $permissions) || request()->user()->role->name == 'admin') {
            $admins = Admin::with(['role', 'adminProfile'])->where('role_id', 1)->get();
            return view('admin_dashboard.user.administrator', compact('admins'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function user()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('users', $permissions) || request()->user()->role->name == 'admin') {
            $users = User::with(['role', 'userProfile'])->get();
            return view('admin_dashboard.user.user', compact('users'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function deleteUser(User $user)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('users', $permissions) || request()->user()->role->name == 'admin') {
            if ($user->delete()) {
                if(Storage::exists('public/'.$user->profile_photo_path)){
                    Storage::delete(['public/'.$user->profile_photo_path]);
                }
                $user->userProfile()->delete();
                $user->comments()->delete();
                $user->message()->delete();
                return redirect()->route('admin.user.view')->with('success', 'User successfully deleted');
            } else {
                return redirect()->route('admin.user.view')->with('error', 'User not deleted');
            }
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
    
    public function index()
    {
        $admins = Admin::with(['role', 'adminProfile'])->where('role_id', '!=', 1)->get();
        return view('admin_dashboard.user.staff', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 2)->get();
        return view('admin_dashboard.user.create-staff', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        $save = Admin::create([
            'name' => strtolower($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => Hash::make(123),
            'role_id' => strtolower($request->input('role_id')),
        ]);

        if ($save) {
            return redirect()->route('admin.staff.view')->with('success', 'Staff successfully created');
        } else {
            return redirect()->route('admin.staff.view')->with('error', 'Staff not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::where('id', '!=', 2)->get();
        return view('admin_dashboard.user.edit-staff', compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        $admin->name = strtolower($request->input('name'));
        $admin->email = strtolower($request->input('email'));
        $admin->role_id = strtolower($request->input('role_id'));

        if ($admin->save()) {
            if ($admin->role_id == 1) {
                return redirect()->route('admin.administrator.view')->with('success', 'Profile successfully updated');
            }
            return redirect()->route('admin.staff.view')->with('success', 'Staff successfully updated');
        } else {
            if ($admin->role_id == 1) {
                return redirect()->route('admin.administrator.view')->with('error', 'Profile not updated');
            }
            return redirect()->route('admin.staff.view')->with('error', 'Staff not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if ($admin->delete()) {
            if(Storage::exists('public/'.$admin->profile_photo_path)){
                Storage::delete(['public/'.$admin->profile_photo_path]);
            }
            $admin->adminProfile()->delete();
            return redirect()->route('admin.staff.view')->with('success', 'Staff successfully deleted');
        } else {
            return redirect()->route('admin.staff.view')->with('error', 'Staff not deleted');
        }
    }
}

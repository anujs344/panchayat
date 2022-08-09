<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Actions\Fortify\PasswordValidationRules;

class AdminProfileController extends Controller
{
    use PasswordValidationRules;
    
    public function index()
    {
        return view('admin_dashboard.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        if ($request->hasFile('file')) {
            $photo = $request->file('file');
            $image = 'profile'.time().'.'.$photo->clientExtension();
            if(Storage::exists('public/'.$admin->profile_photo_path)){
                Storage::delete(['public/'.$admin->profile_photo_path]);
            }
            $filename = 'profile/'.$image;
            $photo->storeAs('profile',$image,'public');
        } else {
            $filename = $admin->profile_photo_path;
        }
        $admin->profile_photo_path = $filename;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($admin->save()) {
            return redirect()->route('admin.profile.view')->with('success', 'Profile has been successfully saved');
        } else {
            return redirect()->route('admin.profile.view')->with('error', 'Profile has not been successfully saved');
        }
    }

    public function changePassword(Admin $admin, Request $request)
    {
        $permissions = Admin::pluck('id')->toArray();

        if (in_array($admin->id, $permissions) || request()->user()->role->name == 'admin') {
            $request->validate([
                'current_password' => 'required|string',
                'password' => $this->passwordRules(),
            ]);

            if (! Hash::check($request->current_password, $admin->password)) {
                return redirect()->route('admin.profile.view')->with('error', __('The provided password does not match your current password.'));
            }
            $admin->password = Hash::make($request->password);
            
            if ($admin->save()) {
                return redirect()->route('admin.profile.view')->with('success', 'Profile password has been successfully saved');
            } else {
                return redirect()->route('admin.profile.view')->with('error', 'Profile password has not been successfully saved');
            }

        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

}

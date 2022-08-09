<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('dashboard', $permissions) || request()->user()->role->name == 'admin') {
            $data['posts'] = Post::all();
            $data['pendingComments'] = Comment::whereStatus(0)->take(5)->get();
            $data['contactMessages'] = ContactMessage::latest()->take(5)->get();
            $data['users'] = User::latest()->take(5)->get();
            return view('admin_dashboard.dashboard', $data);
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function pending()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('comments', $permissions) || request()->user()->role->name == 'admin') {
            $comments = Comment::whereStatus(0)->get();
            return view('admin_dashboard.comment.pending', compact('comments'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function approved()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('comments', $permissions) || request()->user()->role->name == 'admin') {
            $comments = Comment::whereStatus(1)->get();
            return view('admin_dashboard.comment.approved', compact('comments'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin_dashboard.comment.edit-pending', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'status' => 'required',
        ]);
        
        $comment->status = $request->input('status');
        if ($comment->save()) {
            return redirect()->route('admin.comment.pending')->with('success', 'Comment successfully approved');
        } else {
            return redirect()->route('admin.comment.pending')->with('error', 'Comment not approved');
        }
        
    }

    public function destroyPending(Comment $comment)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('comments', $permissions) || request()->user()->role->name == 'admin') {
            $deleted = $comment->delete();
            if ($deleted) {
                return redirect()->route('admin.comment.pending')->with('success', 'Comment successfully deleted');
            } else {
                return redirect()->route('admin.comment.pending')->with('error', 'Comment not deleted');
            }
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function destroyApproved(Comment $comment)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('comments', $permissions) || request()->user()->role->name == 'admin') {
            $deleted = $comment->delete();
            if ($deleted) {
                return redirect()->route('admin.comment.approved')->with('success', 'Comment successfully deleted');
            } else {
                return redirect()->route('admin.comment.approved')->with('error', 'Comment not deleted');
            }
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
}

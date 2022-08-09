<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('comments', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Comment $comment)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('comments', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $role = $user->role->pluck('name')->toArray();
        return in_array('user', $role) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Comment $comment)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('comments', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Comment $comment)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('comments', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Comment $comment)
    {
        //
    }

    public function before(Admin $admin)
    {
        if ($admin->role->name == 'admin') {
            return true;
        }
    }
}

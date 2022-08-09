<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Navigation;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class NavigationPolicy
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
        return in_array('navigation', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    public function view(Admin $admin, Navigation $navigation)
    {
        //
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('navigation', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Navigation $navigation)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('navigation', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Navigation $navigation)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('navigation', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Navigation $navigation)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Navigation $navigation)
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

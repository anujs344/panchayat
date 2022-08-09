<?php

namespace App\Policies;

use App\Models\RouteSetting;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RouteSettingPolicy
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
        return in_array('route_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, RouteSetting $routeSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('route_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
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
        return in_array('route_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, RouteSetting $routeSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('route_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, RouteSetting $routeSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('route_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, RouteSetting $routeSetting)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, RouteSetting $routeSetting)
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

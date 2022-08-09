<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use App\Models\VisualSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisualSettingPolicy
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
        return in_array('visual_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, VisualSetting $visualSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('visual_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
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
        return in_array('visual_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, VisualSetting $visualSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('visual_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, VisualSetting $visualSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('visual_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, VisualSetting $visualSetting)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, VisualSetting $visualSetting)
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

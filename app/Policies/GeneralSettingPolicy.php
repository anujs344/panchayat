<?php

namespace App\Policies;

use App\Models\GeneralSetting;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralSettingPolicy
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
        return in_array('general_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, GeneralSetting $generalSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('general_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
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
        return in_array('general_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, GeneralSetting $generalSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('general_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, GeneralSetting $generalSetting)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('general_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, GeneralSetting $generalSetting)
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

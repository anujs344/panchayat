<?php

namespace App\Policies;

use App\Models\EmailSetting;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailSettingPolicy
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
        return in_array('email_settings', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, EmailSetting $emailSetting)
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
        //
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, EmailSetting $emailSetting)
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

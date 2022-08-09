<?php

namespace App\Policies;

use App\Models\ContactMessage;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactMessagePolicy
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
        return in_array('contact_messages', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, ContactMessage $contactMessage)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('contact_messages', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
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
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, ContactMessage $contactMessage)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('contact_messages', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, ContactMessage $contactMessage)
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

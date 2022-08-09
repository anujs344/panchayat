<?php

namespace App\Policies;

use App\Models\GalleryCategory;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryCategoryPolicy
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
        return in_array('gallery', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, GalleryCategory $galleryCategory)
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
        return in_array('gallery', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, GalleryCategory $galleryCategory)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('gallery', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, GalleryCategory $galleryCategory)
    {
        $permissions = $admin->role->permissions->pluck('name')->toArray();
        return in_array('gallery', $permissions) ? Response::allow() : Response::deny('You are not allowed for this service.');
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, GalleryCategory $galleryCategory)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, GalleryCategory $galleryCategory)
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

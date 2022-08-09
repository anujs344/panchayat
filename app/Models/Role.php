<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    function staffs()
    {
        return $this->hasMany(Admin::class, 'role_id', 'id');
    }

    function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    function permissions()
    {
        return $this->belongsToMany(Permission::class, RolePermission::class, 'role_id', 'permission_id', 'id', 'id')->withTimestamps();
    }
}

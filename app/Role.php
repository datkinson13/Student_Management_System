<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function Users()
    {
        return $this->belongsToMany(user::class, 'system_roles');
    }

    public function hasAccess($permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    private function hasPermission($permission)
    {
        // if permission is set, return value, otherwise return false.
        return $this->permissions[$permission] != null ? $this->permissions[$permission] : false;
    }
}

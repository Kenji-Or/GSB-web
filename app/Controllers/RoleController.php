<?php
namespace App\Controllers;
use App\Models\Role;

class RoleController
{
    public function listRoles() {
        return Role::getAllRoles();
    }
}
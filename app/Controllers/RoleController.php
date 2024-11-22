<?php
namespace App\Controllers;
use App\Models\Role;

class RoleController
{
    public function listRoles() {
        $roles = Role::getAllRoles();
        require_once __DIR__ . '/../Views/pages/CreateUser.php';
    }
}
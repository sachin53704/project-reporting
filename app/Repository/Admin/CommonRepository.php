<?php

namespace App\Repository\Admin;

use Spatie\Permission\Models\Role;

class CommonRepository{
    // function to get roles
    public function getRoles(){
        return Role::all();
    }
}

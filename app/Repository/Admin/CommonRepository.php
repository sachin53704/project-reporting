<?php

namespace App\Repository\Admin;

use Spatie\Permission\Models\Role;
use App\Models\Project;
use App\Models\WorkStatus;

class CommonRepository{
    // function to get roles
    public function getRoles(){
        return Role::all();
    }

    public function getActiveProject(){
        return Project::where('status', 1)->select('id', 'name')->get();
    }

    public function getActiveWorkStatus(){
        return WorkStatus::where('status', 1)->select('id', 'name')->get();
    }
}

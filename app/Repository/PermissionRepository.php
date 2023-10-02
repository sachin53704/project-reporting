<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function index()
    {
        return Permission::all();
    }

    public function store($req=null)
    {
        $perm = new Permission;
        $perm->name = $req->name;

        if($perm->save())
        {
            return true;
        }
    }

    public function edit($id=null)
    {
        return Permission::find($id);
    }

    public function update($req=null)
    {
        $perm = Permission::find(decrypt($req->get('id')));
        $perm->name = $req->name;

        if($perm->save())
        {
            return true;
        }
    }

    public function delete($req=null)
    {
        $permission = Permission::find($req->get('id'));

        if($permission->delete())
        {
            return true;
        }
    }
}

<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository
{
    public function index()
    {
        return Role::all();
    }

    public function add($req=null)
    {
        return Permission::orderBy('name')->get();;
    }

    public function store($req=null)
    {
        if($req->name)
        {
            Role::create(['name' => $req->get('name')]);
        }

        return true;
    }


    public function getRoleById($id=null)
    {
        return Role::find($id);
    }

    public function getPermission($req=null)
    {
        return Permission::orderBy('name')->get();
    }

    public function getPermissionId($id=null)
    {
        $role = $this->getRoleById($id);

        return $role->permissions->pluck('id')->toArray();
    }

    public function update($req=null)
    {
        $role = Role::find(decrypt($req->id));

        $rolePermisisons = $role->permissions->pluck('id')->toArray();

        foreach($rolePermisisons as $rp) {
            $role->revokePermissionTo($rp);
        }

        if(!empty($req->get('permissions'))) {
            foreach ($req->get('permissions') as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role->givePermissionTo($p);
            }
        }

        return true;
    }
}

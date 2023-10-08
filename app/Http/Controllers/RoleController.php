<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repository\RoleRepository;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        // $this->middleware(['permission:role.add|role.edit|roles.view']);

        $this->roleRepository = $roleRepository;
    }

    public function list(Request $req)
    {
        if($req->ajax())
        {
            $roles = $this->roleRepository->index();

            return DataTables::of($roles)
                    ->addIndexColumn()
                    ->toJson();
        }

        return view('master.role.list');
    }

    public function add()
    {
        $permissions = $this->roleRepository->add();

        return view('master.role.add', compact('permissions'));
    }

    public function store(RoleRequest $req)
    {
        $role = $this->roleRepository->store($req);

        if($role)
        {
            session()->flash('success', 'Role '.$req->name.' added successfully');

            return redirect('/admin/master/role/list');
        }

    }

    public function edit($id)
    {
        $role = $this->roleRepository->getRoleById($id);

        $permissions = $this->roleRepository->getPermission();

        $rolePermisisons = $this->roleRepository->getPermissionId($id);

        return view('master.role.edit', compact('role', 'permissions', 'rolePermisisons'));
    }

    public function update(RoleRequest $request)
    {
        $role = $this->roleRepository->update($request);

        if($role)
        {
            session()->flash('success', 'Role '.$request->name.' updated successfully');

            return redirect('/admin/master/role/list');
        }
    }
}

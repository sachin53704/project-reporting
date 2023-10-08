<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Repository\PermissionRepository;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        // $this->middleware(['permission:permission.add|permission.delete|permission.edit|permissions.view']);

        $this->permissionRepository = $permissionRepository;
    }

    public function list(Request $req)
    {
        if($req->ajax())
        {
            $permissions = $this->permissionRepository->index();

            return DataTables::of($permissions)
                    ->addIndexColumn()
                    ->toJson();
        }

        return view('master.permission.list');
    }

    public function add()
    {
        return view('master.permission.add');
    }

    public function store(PermissionRequest $req)
    {
        $permission = $this->permissionRepository->store($req);

        if($permission)
        {
            return redirect('/admin/master/permission/list');
        }
    }

    public function edit($id)
    {
        $permission = $this->permissionRepository->edit($id);

        return view('master.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request)
    {
        $permission = $this->permissionRepository->update($request);

        if($permission)
        {
            return redirect('admin/master/permission/list');
        }
    }

    public function delete(Request $request)
    {
        $permission = $this->permissionRepository->delete($request);

        if($permission)
        {
            return redirect('admin/master/permission/list');
        }
    }
}

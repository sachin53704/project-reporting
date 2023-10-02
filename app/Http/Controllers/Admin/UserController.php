<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Admin\UserRepository;
use App\Repository\Admin\CommonRepository;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    protected $userRepository;
    protected $commonRepository;

    public function __construct(UserRepository $userRepository, CommonRepository $commonRepository)
    {
        $this->userRepository = $userRepository;

        $this->commonRepository = $commonRepository;
    }

    public function list(Request $req){
        // $users = $this->userRepository->list();
        // return $users;
        if($req->ajax()){
            $users = $this->userRepository->list();

            return DataTables::of($users)
                    ->addIndexColumn()
                    ->editColumn('role', function($data){
                        return $data->roles[0]->name;
                    })
                    ->toJson();
        }

        return view('admin.user.list');
    }

    public function add(){
        $roles = $this->commonRepository->getRoles();

        return view('admin.user.add')->with(['roles' => $roles]);
    }

    public function store(Request $req){
        $user = $this->userRepository->store($req);

        if($user){
            session()->flash('success', 'User created successfully');

            return redirect('admin/user/list');
        }
    }

    public function edit($id){
        $roles = $this->commonRepository->getRoles();

        $user = $this->userRepository->edit($id);

        return view('admin.user.edit')->with(['roles' => $roles, 'user' => $user]);
    }

    public function update(Request $req){
        $user = $this->userRepository->update($req);

        if($user){
            session()->flash('success', 'User updated successfully');

            return redirect('admin/user/list');
        }
    }
}

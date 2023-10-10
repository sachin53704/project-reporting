<?php

namespace App\Repository\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Repository\ImageRepository;

class UserRepository{

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    // function to get user list
    public function list(){
        $users = User::select('id', 'name', 'username', 'mobile', 'profile', 'status')->get();

        return $users;
    }

    public function store($req){
        $user = new User;
        $user->name = $req->name;
        $user->username = $req->username;
        $user->mobile = $req->mobile;
        $user->password = bcrypt($req->password);

        $user->profile = $this->imageRepository->storeImage($req, 'profile', 'user/profile', time().Auth::user()->id);

        $user->assignRole($req->assign_role);
        $user->status = $req->status;
        if($user->save()){
            return true;
        }
    }

    public function edit($id){
        return User::with('roles')->find($id);
    }

    public function update($req){
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->username = $req->username;
        $user->mobile = $req->mobile;
        // $user->mobile = $req->mobile;
        if($req->password != "")
            $user->password = bcrypt($req->password);

        $user->profile = $this->imageRepository->updateImage($req, $user->profile,  'profile', 'user/profile', time().Auth::user()->id);
        $user->roles()->detach();
        $user->assignRole($req->assign_role);
        $user->status = $req->status;
        if($user->save()){
            return true;
        }
    }
}

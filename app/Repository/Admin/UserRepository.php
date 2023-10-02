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
        $users = User::withWhereHas('roles')->select('id', 'name', 'email')->get();

        return $users;
    }

    public function store($req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        // $user->mobile = $req->mobile;
        $user->password = bcrypt($req->password);

        // $user->roles()->detach();
        $user->assignRole($req->assign_role);

        // if($req->hasFile('profile')) {
        //     $imageName = time().''.Auth::user()->id.''.$req->profile->getClientOriginalExtension();
        //     $req->file('profile')->storeAs('public/user/profile', $imageName);
        //     $user->profile = 'user/profile/' . $imageName;
        // }

        $user->profile = $this->imageRepository->storeImage($req, 'profile', 'user/profile', time().Auth::user()->id);

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
        $user->email = $req->email;
        // $user->mobile = $req->mobile;
        if($req->password != "")
            $user->password = bcrypt($req->password);

        $user->roles()->detach();
        $user->assignRole($req->assign_role);

        if($user->save()){
            return true;
        }
    }
}

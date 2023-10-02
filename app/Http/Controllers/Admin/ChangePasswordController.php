<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(){
        return view('admin.change-password.edit');
    }

    public function updateChangePassword(Request $request){
        // dd($request);
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches

            return redirect('/admin/change-password/')->with(['error' => "Your current password does not matches with the password you provided. Please try again."]);
        }

        if(strcmp($request->current_password, $request->new_password) == 0){
            //Current password and new password are same
            return redirect('/admin/change-password/')->with(['error' => "New Password cannot be same as your current password. Please choose a different password."]);
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ],[
            'current_password.required' => 'Please enter current password',
            'new_password.required' => 'Please enter new password',
            'new_password.min' => 'Password must be atleast 6 digit',
            'new_password.confirmed' => 'New password and confirm password not matched',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        // change password log when insert
        // $this->logService->insertLog('', 'Chnage Password', '', 'changepassword', [], []);

        return redirect('/admin/change-password/')->with(['message' => "Password Updated Successfully"]);

    }
}

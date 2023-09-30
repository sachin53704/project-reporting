<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        // Auth::logout();
        return view('admin.dashboard');
    }

    public function form(){
        return view('admin.theme.form');
    }

    public function table(){
        return view('admin.theme.table');
    }

    public function login(){
        return view('login');
    }
}

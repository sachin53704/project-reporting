<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Admin\DashboardRepository;

class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    public function dashboard(){
        $tasks = [
            'Total Task' => $this->dashboardRepository->getFilterTotalTask('Total Task'),
            'Yesterday Task' => $this->dashboardRepository->getFilterTotalTask('Yesterday'),
            'This Month Task' => $this->dashboardRepository->getFilterTotalTask('This Month'),
            'Last Month Task' => $this->dashboardRepository->getFilterTotalTask('Last Month'),
        ];

        return view('admin.dashboard')->with(['tasks' => $tasks]);
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

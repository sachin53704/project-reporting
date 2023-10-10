<?php

namespace App\Repository\Admin;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardRepository{
    public function getTotalTaskCount(){
        $task = Task::count();

        return $task;
    }

    public function getFilterTotalTask($type){

        if($type == "Yesterday"){
            $task = Task::whereDate('date', date('Y-m-d', strtotime('-1 days')));
        }

        if($type == "This Month"){
            $task = Task::whereDate('date', '>=', date('Y-m-01'))->whereDate('date', '<=', date('Y-m-t'));
        }

        if($type == "Last Month"){
            $task = Task::whereDate('date', '>=', date('Y-m-01', strtotime('-1 months')))->whereDate('date', '<=', date('Y-m-t', strtotime('-1 months')));
        }

        if($type == "Total Task"){
            if(!Auth::user()->hasRole('Super Admin')){
                return Task::where('user_id', Auth::user()->id)->count();
            }else{
                return Task::count();
            }
        }

        if(!Auth::user()->hasRole('Super Admin')){
            $task = $task->where('user_id', Auth::user()->id);
        }

        return $task->count();
    }
}

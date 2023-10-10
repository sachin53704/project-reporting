<?php

namespace App\Repository;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository{
    public function list(){
        $tasks = Task::join('users', 'users.id', '=', 'tasks.user_id')
               ->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
               ->leftJoin('work_status', 'work_status.id', '=', 'tasks.work_status_id');

        if(!Auth::user()->hasRole('Super Admin')){
            $tasks = $tasks->where('tasks.user_id', Auth::user()->id);
        }

        $tasks = $tasks->select('tasks.id', 'users.name as user_name', 'projects.name as project_name', 'work_status.name as work_status_name', 'tasks.description', 'tasks.start_time', 'tasks.end_time', 'tasks.date', 'tasks.module');

        return $tasks;
    }

    public function store($req){
        if(isset($req->date) && count($req->date) > 0){
            for($i=0; $i<count($req->date); $i++){
                $task = new Task;
                $task->user_id = Auth::user()->id;
                $task->project_id = $req->project_id[$i];
                $task->work_status_id = $req->work_status_id[$i];
                $task->module = $req->module[$i];
                $task->description = $req->description[$i];
                $task->date = date('Y-m-d', strtotime($req->date[$i]));
                $task->start_time = date('H:i:s', strtotime($req->start_time[$i]));
                $task->end_time = date('H:i:s', strtotime($req->end_time[$i]));
                $task->save();
            }

            return true;
        }
    }

    public function edit($id){
        return Task::find($id);
    }

    public function update($req){
        $task = Task::find($req->id);
        $task->project_id = $req->project_id;
        $task->work_status_id = $req->work_status_id;
        $task->description = $req->description;
        $task->module = $req->module;
        $task->date = date('Y-m-d', strtotime($req->date));
        $task->start_time = date('H:i:s', strtotime($req->start_time));
        $task->end_time = date('H:i:s', strtotime($req->end_time));
        if($task->save()){
            return true;
        }
    }
}

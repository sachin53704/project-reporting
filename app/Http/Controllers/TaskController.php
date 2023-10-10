<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TaskRepository;
use App\Repository\Admin\CommonRepository;
use Yajra\Datatables\Datatables;

class TaskController extends Controller
{
    protected $taskRepository, $commonRepository;

    public function __construct(TaskRepository $taskRepository, CommonRepository $commonRepository){
        $this->taskRepository = $taskRepository;
        $this->commonRepository = $commonRepository;
    }

    public function list(Request $req){
        if($req->ajax()){
            $tasks = $this->taskRepository->list();

            return DataTables::of($tasks)
                    ->addIndexColumn()
                    ->editColumn('date', function($data){
                        return date('d-m-Y', strtotime($data->date)) ?? '';
                    })
                    ->editColumn('start_time', function($data){
                        return date('h:i A', strtotime($data->start_time)) ?? '';
                    })
                    ->editColumn('end_time', function($data){
                        return date('h:i A', strtotime($data->end_time)) ?? '';
                    })
                    ->toJson();
        }

        return view('task.list');
    }

    public function add(){
        $projects = $this->commonRepository->getActiveProject();

        $workStatus = $this->commonRepository->getActiveWorkStatus();

        return view('task.add')->with([
            'projects' => $projects,
            'workStatus' => $workStatus
        ]);
    }

    public function store(Request $req){
        $task = $this->taskRepository->store($req);

        if($task){
            session()->flash('success', 'Task created successfully');

            return redirect('/admin/task/list');
        }
    }

    public function edit($id){
        $task = $this->taskRepository->edit($id);

        $projects = $this->commonRepository->getActiveProject();

        $workStatus = $this->commonRepository->getActiveWorkStatus();

        return view('task.edit')->with([
            'task' => $task,
            'projects' => $projects,
            'workStatus' => $workStatus
        ]);
    }

    public function update(Request $req){
        $task = $this->taskRepository->update($req);

        if($task){
            session()->flash('success', 'Task updated successfully');

            return redirect('/admin/task/list');
        }
    }
}

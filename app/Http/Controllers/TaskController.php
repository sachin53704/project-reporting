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
                    ->toJson();
        }

        return view('task.list');
    }

    public function add(){
        $projects = $this->commonRepository->getActiveProject();

        $projectTypes = $this->commonRepository->getActiveProjectType();

        return view('task.add')->with([
            'projects' => $projects,
            'projectTypes' => $projectTypes
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

        $projectTypes = $this->commonRepository->getActiveProjectType();

        return view('task.edit')->with([
            'task' => $task,
            'projects' => $projects,
            'projectTypes' => $projectTypes
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

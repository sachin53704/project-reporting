<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Admin\ProjectRepository;
use Yajra\Datatables\Datatables;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository){
        $this->projectRepository = $projectRepository;
    }

    public function list(Request $req){
        if($req->ajax()){
            $projects = $this->projectRepository->list();

            return DataTables::of($projects)
                    ->addIndexColumn()
                    ->toJson();
        }

        return view('master.projects.list');
    }

    public function add(){
        return view('master.projects.add');
    }

    public function store(Request $req){
        $project = $this->projectRepository->store($req);

        if($project){
            session()->flash('success', 'Project created successfully');

            return redirect('admin/master/project/list');
        }
    }

    public function edit($id){
        $project = $this->projectRepository->edit($id);

        return view('master.projects.edit')->with(['project' => $project]);
    }

    public function update(Request $req){
        $project = $this->projectRepository->update($req);

        if($project){
            session()->flash('success', 'Project updated successfully');

            return redirect('admin/master/project/list');
        }
    }
}

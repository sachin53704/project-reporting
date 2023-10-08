<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Admin\ProjectTypeRepository;
use Yajra\Datatables\Datatables;

class ProjectTypeController extends Controller
{
    protected $projectTypeRepository;

    public function __construct(ProjectTypeRepository $projectTypeRepository){
        $this->projectTypeRepository = $projectTypeRepository;
    }

    public function list(Request $req){
        if($req->ajax()){
            $projectTypes = $this->projectTypeRepository->list();

            return DataTables::of($projectTypes)
                    ->addIndexColumn()
                    ->toJson();
        }

        return view('master.project_type.list');
    }

    public function add(){
        return view('master.project_type.add');
    }

    public function store(Request $req){
        $projectType = $this->projectTypeRepository->store($req);

        if($projectType){
            session()->flash('success', 'Project Type created successfully');

            return redirect('admin/master/project-type/list');
        }
    }

    public function edit($id){
        $projectType = $this->projectTypeRepository->edit($id);

        return view('master.project_type.edit')->with(['projectType' => $projectType]);
    }

    public function update(Request $req){
        $projectType = $this->projectTypeRepository->update($req);

        if($projectType){
            session()->flash('success', 'Project type updated successfully');

            return redirect('admin/master/project-type/list');
        }
    }
}

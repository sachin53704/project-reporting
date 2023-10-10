<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Admin\WorkStatusRepository;
use Yajra\Datatables\Datatables;

class WorkStatusController extends Controller
{
    protected $workStatusRepository;

    public function __construct(WorkStatusRepository $workStatusRepository){
        $this->workStatusRepository = $workStatusRepository;
    }

    public function list(Request $req){
        if($req->ajax()){
            $projectTypes = $this->workStatusRepository->list();

            return DataTables::of($projectTypes)
                    ->addIndexColumn()
                    ->toJson();
        }

        return view('master.work_status.list');
    }

    public function add(){
        return view('master.work_status.add');
    }

    public function store(Request $req){
        $projectType = $this->workStatusRepository->store($req);

        if($projectType){
            session()->flash('success', 'Work status created successfully');

            return redirect('admin/master/work-status/list');
        }
    }

    public function edit($id){
        $projectType = $this->workStatusRepository->edit($id);

        return view('master.work_status.edit')->with(['projectType' => $projectType]);
    }

    public function update(Request $req){
        $projectType = $this->workStatusRepository->update($req);

        if($projectType){
            session()->flash('success', 'Work status updated successfully');

            return redirect('admin/master/work-status/list');
        }
    }
}

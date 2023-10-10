<?php

namespace App\Repository\Admin;

use App\Models\WorkStatus;

class WorkStatusRepository{
    public function list(){
        return WorkStatus::select('id', 'name', 'status');
    }

    public function store($req){
        $workStatus = new WorkStatus;
        $workStatus->name = $req->name;
        $workStatus->status = $req->status;
        if($workStatus->save()){
            return true;
        }
    }

    public function edit($id){
        return WorkStatus::find($id);
    }

    public function update($req){
        $workStatus = WorkStatus::find($req->id);
        $workStatus->name = $req->name;
        $workStatus->status = $req->status;
        if($workStatus->save()){
            return true;
        }
    }
}

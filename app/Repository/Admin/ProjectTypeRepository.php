<?php

namespace App\Repository\Admin;

use App\Models\ProjectType;

class ProjectTypeRepository{
    public function list(){
        return ProjectType::select('id', 'name', 'status');
    }

    public function store($req){
        $projectType = new ProjectType;
        $projectType->name = $req->name;
        $projectType->status = $req->status;
        if($projectType->save()){
            return true;
        }
    }

    public function edit($id){
        return ProjectType::find($id);
    }

    public function update($req){
        $projectType = ProjectType::find($req->id);
        $projectType->name = $req->name;
        $projectType->status = $req->status;
        if($projectType->save()){
            return true;
        }
    }
}
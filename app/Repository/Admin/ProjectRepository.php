<?php

namespace App\Repository\Admin;

use App\Models\Project;

class ProjectRepository{
    public function list(){
        return Project::select('id', 'name', 'status');
    }

    public function store($req){
        $project = new Project;
        $project->name = $req->name;
        $project->status = $req->status;
        if($project->save()){
            return true;
        }
    }

    public function edit($id){
        return Project::find($id);
    }

    public function update($req){
        $project = Project::find($req->id);
        $project->name = $req->name;
        $project->status = $req->status;
        if($project->save()){
            return true;
        }
    }
}
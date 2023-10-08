@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/task/list')}}">Task</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            {{-- <div class="page-title-right">
                <a href="{{url('master/permissions')}}" class="btn btn-primary btn-sm">Back</a>
            </div> --}}

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/task/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}" />
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Date <span class="text-danger">*</span></label>
                        @error('date')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="date" autocomplete="off" name="date" required value="{{ $task->date }}">
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Select Project <span class="text-danger">*</span></label>
                        <select class="form-select" name="project_id" required>
                            <option value="">Select</option>
                            @foreach($projects as $project)
                            <option  @if($task->project_id == $project->id)selected @endif value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Description <span class="text-danger">*</span></label>
                        @error('description')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <textarea class="form-control" name="description" required>{{ $task->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Select Work Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="project_type_id" required>
                            <option value="">Select</option>
                            @foreach($projectTypes as $projectType)
                            <option  @if($task->project_type_id == $projectType->id)selected @endif value="{{$projectType->id}}">{{$projectType->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Date <span class="text-danger">*</span></label>
                        @error('start_time')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="time" autocomplete="off" name="start_time" required value="{{ $task->start_time }}">
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Date <span class="text-danger">*</span></label>
                        @error('end_time')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="time" autocomplete="off" name="end_time" required value="{{ $task->end_time }}">
                    </div>

                    <a href="{{url('admin/task/list')}}" class="btn btn-danger waves-effect waves-light w-md">Cancel</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

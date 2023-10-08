@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/master/project/list')}}">Project</a></li>
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
                <form action="{{url('admin/master/project/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $project->id }}" />
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="text" autocomplete="off" name="name" placeholder="Enter name" value="{{ $project->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="ccol-form-label">Select Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status">
                            <option @if($project->status == "1")selected @endif value="1">Active</option>
                            <option @if($project->status == "0")selected @endif value="0">Inactive</option>
                        </select>
                    </div>

                    <a href="{{url('admin/master/project/list')}}" class="btn btn-danger waves-effect waves-light w-md">Cancel</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

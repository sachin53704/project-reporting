@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/user/list')}}">User</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                <form action="{{url('admin/user/store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="text" autocomplete="off" name="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Username <span class="text-danger">*</span></label>
                        @error('username')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="text" autocomplete="off" name="username" placeholder="Enter username">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Mobile <span class="text-danger">*</span></label>
                        @error('mobile')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="number" autocomplete="off" name="mobile" placeholder="Enter mobile">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Password <span class="text-danger">*</span></label>
                        @error('password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="password" autocomplete="off" name="password" placeholder="Enter password">
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Profile Image </label>
                        @error('profile')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="file" accept="image/*" name="profile">
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Select Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="assign_role">
                            <option>Select</option>
                            @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Select Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <a href="{{url('admin/user/list')}}" class="btn btn-danger waves-effect waves-light w-md">Cancel</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

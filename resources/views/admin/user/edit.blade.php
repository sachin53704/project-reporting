@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/user/list')}}">User</a></li>
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
                <form action="{{url('admin/user/update')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}" />
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="text" value="{{$user->name}}" autocomplete="off" name="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Email <span class="text-danger">*</span></label>
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="email" value="{{$user->email}}" autocomplete="off" name="email" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">New Password </label>
                        @error('password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="password" autocomplete="off" name="password" placeholder="Enter password">
                    </div>

                    <div class="mb-3">
                        <label class="ccol-form-label">Select Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="assign_role">
                            <option>Select</option>
                            @foreach($roles as $role)
                            <option @if($role->id == $user->roles[0]->pivot->role_id)selected @endif value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
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

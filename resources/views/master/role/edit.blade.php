@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('master/roles')}}">Role</a></li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </div>
            {{-- <div class="page-title-right">
                <a href="{{url('master/roles')}}" class="btn btn-primary btn-sm">Back</a>
            </div> --}}

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('master/roles/update')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{encrypt($role->id)}}" />
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Name :</label>
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="text" autocomplete="off" name="name" value="{{$role->name}}" placeholder="Enter role name">
                    </div>

                    <div class="permissions-form">
                        <div class="form-input_container">
                            <label>Permissions</label>
                        </div>


                        <div class=" table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>User</td>
                                        <td>
                                            <?php $org = ['user.add', 'user.edit', 'user.list']; ?>
                                            <div class="row permissions-check d-flex">
                                            @foreach($permissions as $perm)
                                            @if(in_array($perm->name, $org))
                                                <div class="col-6 col-md-3 col-lg-3 permissions-check_list1">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <label class="d-flex align-items-center">
                                                                <input type="checkbox" class="check-input" name="permissions[]"  @if(in_array($perm->id, $rolePermisisons)) checked @endif value="{{ $perm->id }}">&nbsp;&nbsp;{{$perm->name}}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                            @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <a href="{{url('master/roles')}}" class="btn btn-danger waves-effect waves-light w-md">Cancel</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

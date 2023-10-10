@extends('admin.layouts.master')

@section('body')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/user/list')}}">User</a></li>
                    <li class="breadcrumb-item active">list</li>
                </ol>
            </div>
            @can('user.add')
            <div class="page-title-right">
                <a href="{{url('admin/user/add')}}" class="btn btn-primary btn-sm">Add</a>
            </div>
            @endcan

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- <div class="d-flex justify-content-end">

                </div> --}}
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatable').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/admin/user/list') }}",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'profile',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            return `<img src="${data}" style="width:50px;height:auto;" >`;
                        },
                    },
                    {
                        data: 'username',
                        name: 'username',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'role',
                        name: 'role',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row){
                            let html = "";
                            if(data == "1"){
                                html += `<span class="badge bg-success">Active</span>`;
                            }else{
                                html += `<span class="badge bg-danger">Inactive</span>`;
                            }
                            return html;
                        },
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            let html = '';
                            @can('user.edit')
                            html = `<a href="{{url('/')}}/admin/user/edit/${data}"><i class="bx bx-edit"></i></a>`;
                            @endcan
                            return html;
                        },
                    }
                ]
            });

            @include('admin.message.message')
        });
    </script>
@endpush

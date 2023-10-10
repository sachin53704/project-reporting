@extends('admin.layouts.master')

@section('body')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('/admin/task/list')}}">Task</a></li>
                    <li class="breadcrumb-item active">list</li>
                </ol>
            </div>
            @can('task.add')
            <div class="page-title-right">
                <a href="{{url('/admin/task/add')}}" class="btn btn-primary btn-sm">Add</a>
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
                            <th>User</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Project</th>
                            <th>Module</th>
                            <th>Work Status</th>
                            <th>Description</th>
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
                    url: "{{ url('/admin/task/list') }}",
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
                        data: 'user_name',
                        name: 'users.name',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'date',
                        name: 'tasks.date',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'start_time',
                        name: 'tasks.start_time',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'end_time',
                        name: 'tasks.end_time',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'project_name',
                        name: 'projects.name',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'module',
                        name: 'projects.module',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'work_status_name',
                        name: 'work_status.name',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'description',
                        name: 'tasks.description',
                        render: function(data, type, row){
                            return data;
                        },
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            let html = '';
                            @can('task.edit')
                            html = `<a href="{{url('/')}}/admin/task/edit/${data}"><i class="bx bx-edit"></i></a>`;
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

@extends('admin.layouts.master')

@section('body')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/master/role/list')}}">Role</a></li>
                    <li class="breadcrumb-item active">list</li>
                </ol>
            </div>
            @can('role.add')
            <div class="page-title-right">
                <a href="{{url('admin/master/role/add')}}" class="btn btn-primary btn-sm">Add</a>
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
                    url: "{{ url('/admin/master/role/list') }}",
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
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row){
                            let html = '';
                            @can('role.edit')
                            html = `<a href="{{url('/')}}/admin/master/role/edit/${data}"><i class="bx bx-edit"></i></a>`;
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

@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('admin/task/add')}}">Task</a></li>
                    <li class="breadcrumb-item active">add</li>
                </ol>
            </div>
            {{-- <div class="page-title-right">
                <a href="{{url('admin/master/permission/list')}}" class="btn btn-primary btn-sm">Back</a>
            </div> --}}

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/task/store')}}" method="post">
                    @csrf
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project</th>
                                <th>Module</th>
                                <th>Description</th>
                                <th>Work Status</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th><button type="button" class="btn btn-primary btn-sm" id="addMore"><i class="bx bx-plus-medical"></i></button></th>
                            </tr>
                        </thead>

                        <tbody id="addTaskRow">
                            <tr id="row1">
                                <td>
                                    <input type="date" class="form-control" name="date[]" required />
                                </td>
                                <td>
                                    <select class="form-select" name="project_id[]" required>
                                        <option value="">Select</option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="module[]" />
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" required></textarea>
                                </td>
                                <td>
                                    <select class="form-select" name="work_status_id[]" required>
                                        <option value="">Select</option>
                                        @foreach($workStatus as $workStat)
                                        <option value="{{ $workStat->id }}">{{ $workStat->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="start_time[]" required />
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="end_time[]" required />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove" data-id="1"><i class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{url('admin/task/list')}}" class="btn btn-danger waves-effect waves-light w-md">Cancel</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            let count = 2;
            $('#addMore').click(function(){
                let html = `<tr id="row${count}">
                                <td>
                                    <input type="date" class="form-control" name="date[]" required />
                                </td>
                                <td>
                                    <select class="form-select" name="project_id[]" required>
                                        <option value="">Select</option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="module[]" />
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" required></textarea>
                                </td>
                                <td>
                                    <select class="form-select" name="work_status_id[]" required>
                                        <option value="">Select</option>
                                        @foreach($workStatus as $workStat)
                                        <option value="{{ $workStat->id }}">{{ $workStat->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="start_time[]" required />
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="end_time[]" required />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove" data-id="${count}"><i class="bx bx-trash"></i></button>
                                </td>
                            </tr>`;
                $('#addTaskRow').append(html);
                count = count + 1;
            });

            $('body').on('click', '.remove', function(){
                let id = $(this).data('id');
                $('#row'+id).remove();
            })
        })
    </script>
@endpush

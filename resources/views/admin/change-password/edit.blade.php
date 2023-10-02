@extends('admin.layouts.master')

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            {{-- <h4 class="mb-0">Permission</h4> --}}

            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.save.change-password')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Current Password :</label>
                        @error('current_password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="password" name="current_password" autocomplete="off" placeholder="Enter current password">
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">New Password :</label>
                        @error('new_password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="password" name="new_password" autocomplete="off" placeholder="Enter new password">
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Confirm New Password :</label>
                        @error('new_password_confirmation')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input class="form-control" type="password" name="new_password_confirmation" placeholder="Confirm new password">
                    </div>

                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@push('scripts')
    <script>
        @include('admin.message.message')
    </script>
@endpush

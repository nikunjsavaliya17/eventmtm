@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Admin User</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('admin_users.index') }}" class="dt-button create-new btn btn-warning" tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"> <span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => 'admin_users.store_update', 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($user))
                    <input type="hidden" name="update_id" value="{{ $user->user_id }}">
                @endif
                <div class="col-md-6 col-12">
                    <label class="form-label" for="title">Name</label>
                    {!! Form::text('name', $user->name ?? old('name'), ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
                </div>
                <div class="col-md-6 col-12">
                    <label class="form-label" for="title">Role</label>
                    {!! Form::select('role', $roles, isset($user) ? $assign_role : old('name'), ['class' => 'form-control select2', 'placeholder' => 'select', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-12">
                    <label class="form-label" for="title">Email</label>
                    {!! Form::email('email', $user->email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'readonly' => isset($user)]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" class="form-control form-control-merge" id="login-password"
                               name="password" tabindex="2" @if($formMode == "Add") required @endif
                               placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                               aria-describedby="login-password"/>
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('footer_scripts')
    <script src="{{ asset('assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
        });
    </script>
@endpush

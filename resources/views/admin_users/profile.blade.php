@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Profile</h4>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['profile.update'], 'id' => 'adminUserForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                <div class="col-md-6 col-12 position-relative">
                    <label class="form-label" for="title">Name</label>
                    {!! Form::text('name', $admin->name ?? old('name'), ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
                </div>
                <div class="col-md-6 col-12 position-relative">
                    <label class="form-label" for="title">Email</label>
                    {!! Form::email('email', $admin->email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'disabled' => isset($admin)]) !!}
                </div>
                <div class="col-md-6 col-12 position-relative">
                    <label class="form-label" for="title">Image</label>
                    <input type="file" accept="image/*" class="dropifyImage"
                           data-allowed-file-extensions="png jpg jpeg svg tif"
                           @if (isset($admin) && $admin->image != '') data-default-file="{{ getFileUrl($admin->image, 'admin') }}"
                           @endif
                           name="image" id="image">
                    <input type="hidden" id="removeImage" name="removeImage" value="false">
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.css') }}">
@endpush
@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/dropify/js/dropify.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#adminUserForm").validate({
                rules: {
                    'name': {
                        required: true,
                    },
                    'email': {
                        required: true,
                        email: true,
                    },
                }
            });

            $('.dropifyImage').dropify();

            $(document).on('click', '.dropify-clear', function () {
                $("#removeImage").val('true');
            })
        })
    </script>
@endpush

@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Event Company</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('event_company_management.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['event_company_management.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($eventCompany))
                    <input type="hidden" name="update_id" value="{{ $eventCompany->event_company_id }}">
                @endif
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Title</label>
                    {!! Form::text('title', $eventCompany->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Email</label>
                    {!! Form::text('email', $eventCompany->email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Mobile Number</label>
                    {!! Form::number('phone_number', $eventCompany->phone_number ?? old('phone_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">ABN Number</label>
                    {!! Form::text('abn_number', $eventCompany->abn_number ?? old('abn_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Address</label>
                    {!! Form::text('address', $eventCompany->address ?? old('address'), ['class' => 'form-control', 'placeholder' => 'Enter address', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Name</label>
                    {!! Form::text('contact_name', $eventCompany->contact_name ?? old('contact_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Email</label>
                    {!! Form::email('contact_email', $eventCompany->contact_email ?? old('contact_email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Number</label>
                    {!! Form::number('contact_phone_number', $eventCompany->contact_phone_number ?? old('contact_phone_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Username</label>
                    {!! Form::text('username', $eventCompany->username ?? old('username'), ['class' => 'form-control', 'placeholder' => 'Enter username', 'required' => true]) !!}
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
@endpush
@push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
        });
    </script>
@endpush

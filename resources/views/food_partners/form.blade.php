@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Food Partner</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('food_partners.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['food_partners.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($foodPartner))
                    <input type="hidden" name="update_id" value="{{ $foodPartner->food_partner_id }}">
                @endif
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Company Name</label>
                    {!! Form::text('company_name', $foodPartner->company_name ?? old('company_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Name</label>
                    {!! Form::text('contact_name', $foodPartner->contact_name ?? old('contact_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Email</label>
                    {!! Form::email('contact_email', $foodPartner->contact_email ?? old('contact_email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Number</label>
                    {!! Form::number('contact_phone_number', $foodPartner->contact_phone_number ?? old('contact_phone_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Address</label>
                    {!! Form::text('address', $foodPartner->address ?? old('address'), ['class' => 'form-control', 'placeholder' => 'Enter address', 'required' => true]) !!}
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Description</label>
                    {!! Form::text('description', $foodPartner->description ?? old('description'), ['class' => 'form-control', 'placeholder' => 'Enter description', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Username</label>
                    {!! Form::text('username', $foodPartner->username ?? old('username'), ['class' => 'form-control', 'placeholder' => 'Enter username', 'required' => true]) !!}
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
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">ABN Number</label>
                    {!! Form::text('abn_number', $foodPartner->abn_number ?? old('abn_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">BSB Number</label>
                    {!! Form::text('bsb_number', $foodPartner->bsb_number ?? old('bsb_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Bank Name</label>
                    {!! Form::text('bank_name', $foodPartner->bank_name ?? old('bank_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Bank Account Number</label>
                    {!! Form::number('bank_account_number', $foodPartner->bank_account_number ?? old('bank_account_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Bank Account Holder Name</label>
                    {!! Form::text('bank_account_holder_name', $foodPartner->bank_account_holder_name ?? old('bank_account_holder_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Logo</label>
                    <input type="file" accept="image/*" class="dropifyImage"
                           data-allowed-file-extensions="png jpg jpeg" data-show-remove="false"
                           @if (isset($foodPartner) && $foodPartner->logo != '') data-default-file="{{ getFileUrl($foodPartner->logo, \App\Models\FoodPartner::IMG_DIR) }}" @else required
                           @endif
                           name="logo" id="logo">
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
            $("#inputForm").validate();
            $('.dropifyImage').dropify();
        })
    </script>
@endpush

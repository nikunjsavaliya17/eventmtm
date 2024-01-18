@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Sponsor</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('sponsors.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['sponsors.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($sponsor))
                    <input type="hidden" name="update_id" value="{{ $sponsor->sponsor_id }}">
                @endif
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Sponsor Type</label>
                    {!! Form::select('sponsor_type_id', $sponsorTypes, $sponsor->sponsor_type_id ?? old('sponsor_type_id'), ['class' => 'form-control select2', 'placeholder' => 'Select', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Event</label>
                    {!! Form::select('event_id', $events, $sponsor->event_id ?? old('event_id'), ['class' => 'form-control select2', 'placeholder' => 'Select', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Company Name</label>
                    {!! Form::text('company_name', $sponsor->company_name ?? old('company_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Name</label>
                    {!! Form::text('contact_name', $sponsor->contact_name ?? old('contact_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Contact Email</label>
                    {!! Form::email('email', $sponsor->email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Mobile Number</label>
                    {!! Form::number('mobile_number', $sponsor->mobile_number ?? old('mobile_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Logo</label>
                    <input type="file" accept="image/*" class="dropifyImage"
                           data-allowed-file-extensions="png jpg jpeg" data-show-remove="false"
                           @if (isset($sponsor) && $sponsor->logo != '') data-default-file="{{ getFileUrl($sponsor->logo, \App\Models\Sponsor::IMG_DIR) }}"
                           @else required
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
            $('.dropifyImage').dropify();
        })
    </script>
@endpush

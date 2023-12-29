@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Event</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('event_management.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['event_management.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($event))
                    <input type="hidden" name="update_id" value="{{ $event->event_id }}">
                @endif
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Event Company</label>
                    {!! Form::select('event_company_id', $companies, $event->event_company_id ?? old('event_company_id'), ['class' => 'form-control select2', 'placeholder' => 'Select', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Title</label>
                    {!! Form::text('title', $event->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => true]) !!}
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Description</label>
                    {!! Form::text('description', $event->description ?? old('description'), ['class' => 'form-control', 'placeholder' => 'Enter description', 'required' => true]) !!}
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="fp-date-time">Start Date - End Date</label>
                    <input type="text" name="date_range" id="fp-range" class="form-control flatpickr-range" required value="{{ isset($event) ? formatDate($event->start_date,'Y-m-d').' to '.formatDate($event->end_date,'Y-m-d') : old('date_range') }}"
                           placeholder="YYYY-MM-DD to YYYY-MM-DD"/>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Image</label>
                    <input type="file" accept="image/*" class="dropifyImage"
                           data-allowed-file-extensions="png jpg jpeg" data-show-remove="false"
                           @if (isset($event) && $event->image != '') data-default-file="{{ getFileUrl($event->image, \App\Models\Event::IMG_DIR) }}"
                           @else required @endif
                           name="image" id="image">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label">Contact Name</label>
                    {!! Form::text('contact_name', $event->contact_name ?? old('contact_name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => true]) !!}
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label">Contact Email</label>
                    {!! Form::email('contact_email', $event->contact_email ?? old('contact_email'), ['class' => 'form-control', 'placeholder' => 'Enter email', 'required' => true]) !!}
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label">Contact Number</label>
                    {!! Form::number('contact_phone_number', $event->contact_phone_number ?? old('contact_phone_number'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => true]) !!}
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endpush
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endpush
@push('footer_scripts')
    <script src="{{ asset('assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/dropify/js/dropify.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
            $('.dropifyImage').dropify();

            $("#fp-range").flatpickr({
                mode: 'range'
            });

        });
    </script>
@endpush

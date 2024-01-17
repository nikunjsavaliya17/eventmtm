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
                <div class="col-md-4 col-12 mb-1">
                    <label class="form-label" for="fp-date-time">Start Date & Time</label>
                    <input type="text" class="form-control form-control-solid" id="start_date" required
                           name="start_date"
                           value="{{ isset($event) ? formatDate($event->start_date, 'd-m-Y H:i') : old('start_date') }}"
                           placeholder="DD-MM-YYYY HH:MM" autocomplete="off">
                </div>
                <div class="col-md-4 col-12 mb-1">
                    <label class="form-label" for="fp-date-time">End Date & Time</label>
                    <input type="text" class="form-control form-control-solid" id="end_date" required
                           name="end_date"
                           value="{{ isset($event) ? formatDate($event->end_date, 'd-m-Y H:i') : old('end_date') }}"
                           placeholder="DD-MM-YYYY HH:MM" autocomplete="off">
                </div>
                <div class="col-md-4 col-sm-12">
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
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Address</label>
                    {!! Form::text('address', $event->address ?? old('address'), ['class' => 'form-control', 'placeholder' => 'Enter address', 'required' => true]) !!}
                </div>
                <div class="col-md-3 col-sm-12">
                    <label class="form-label">Latitude</label>
                    {!! Form::number('latitude', $event->latitude ?? old('latitude'), ['class' => 'form-control', 'placeholder' => 'Enter latitude', 'required' => true]) !!}
                </div>
                <div class="col-md-3 col-sm-12">
                    <label class="form-label">Longitude</label>
                    {!! Form::number('longitude', $event->longitude ?? old('longitude'), ['class' => 'form-control', 'placeholder' => 'Enter longitude', 'required' => true]) !!}
                </div>
            </div>
            <div id="imageRepeaterDiv">
                <div class="divider divider-center divider-primary">
                    <div class="divider-text">
                        <button class="btn btn-outline-primary text-nowrap px-1" data-repeater-create type="button">
                            <i data-feather="plus" class="me-25"></i> Add Media
                        </button>
                    </div>
                </div>
                <div class="row" data-repeater-list="media_list">
                    @if(isset($event) && count($event->relatedMedia))
                        @foreach($event->relatedMedia as $media)
                            <div class="col-md-4" data-repeater-item>
                                <div class="row">
                                    <div class="col-md-10 col-12">
                                        <div class="mb-1">
                                            <input type="hidden" name="exist_id" value="{{ $media->event_media_id }}">
                                            <input type="file" accept="image/*,video/mp4" class="cloneDropifyImage"
                                                   data-allowed-file-extensions="png jpg jpeg mp4" data-show-remove="false"
                                                   name="media"
                                                   data-default-file="{{ getFileUrl($media->media_value, \App\Models\EventMedia::MEDIA_DIR) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                                type="button">
                                            <i data-feather="x" class="me-25"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-4" data-repeater-item>
                            <div class="row">
                                <div class="col-md-10 col-12">
                                    <div class="mb-1">
                                        <input type="file" accept="image/*,video/mp4" class="cloneDropifyImage"
                                               data-allowed-file-extensions="png jpg jpeg mp4" data-show-remove="false"
                                               name="media" required>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                            type="button">
                                        <i data-feather="x" class="me-25"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
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
    <script src="{{ asset('assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript">
        var eventMediaCount = {{ isset($event) ? count($event->relatedMedia) : 0 }};
        $(document).ready(function () {
            $("#inputForm").validate();
            $('.dropifyImage').dropify();

            var startDate = $('#start_date');
            var endDate = $('#end_date');
            if (startDate.length) {
                startDate.flatpickr({
                    startDate: '-0d',
                    dateFormat: 'd-m-Y H:i',
                    autoclose: true,
                    todayHighlight: true,
                    allowInput: true,
                    enableTime: true
                });
            }
            if (endDate.length) {
                endDate.flatpickr({
                    startDate: '-0d',
                    dateFormat: 'd-m-Y H:i',
                    autoclose: true,
                    todayHighlight: true,
                    allowInput: true,
                    enableTime: true
                });
            }

            $('#imageRepeaterDiv').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({width: 14, height: 14});
                    }
                    $(this).find('.cloneDropifyImage').removeAttr('data-default-file');
                    $(this).find('.cloneDropifyImage').dropify();
                    $(this).find('.cloneDropifyImage').attr('required', true);
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function () {
                    $('.cloneDropifyImage').dropify();
                },
                initEmpty: (eventMediaCount === 0)
            });
        });
    </script>
@endpush

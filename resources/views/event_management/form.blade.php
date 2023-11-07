@extends('layouts.vertical', ['title' => 'Event Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Add', 'sub_title' => 'Event Management'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('event_management.store_update') }}" method="POST"
                          class="needs-validation" enctype="multipart/form-data"
                          novalidate>
                        @csrf
                        <div class="row">
                            @if(isset($event))
                                <input type="hidden" name="update_id" value="{{ $event->event_id }}">
                            @endif
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Event Name</label>
                                    <input type="text" name="title" required class="form-control"
                                           value="{{ $event->title ?? old('title') }}"
                                           placeholder="Event Name">
                                    <div class="invalid-feedback">
                                        Please enter a event name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="event_company_id" class="form-label">Company</label>
                                    <select class="form-select" id="event_company_id" name="event_company_id" required>
                                        <option value="">--SELECT--</option>
                                        @foreach($companies as $company_id => $company_title)
                                            <option value="{{ $company_id }}"
                                                    @if(isset($event) && ($event->event_company_id == $company_id)) selected @endif>{{ $company_title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a company.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control"
                                              placeholder="Enter Description">{{ $event->description ?? old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input class="form-control" id="start_date" type="date" required
                                           value="{{ isset($event) ? formatDate($event->start_date, 'Y-m-d') : old('start_date') }}"
                                           name="start_date">
                                    <div class="invalid-feedback">
                                        Please select a date.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input class="form-control" id="end_date" type="date" required
                                           value="{{ isset($event) ? formatDate($event->end_date, 'Y-m-d') : old('end_date') }}"
                                           name="end_date">
                                    <div class="invalid-feedback">
                                        Please select a date.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" @if(!isset($event)) required @endif>
                                    @if(isset($event) && isset($event->image))
                                        <img src="{{ getFileUrl($event->image, 'event') }}"
                                             alt="{{ $event->image }}" width="200px">
                                    @endif
                                    <div class="invalid-feedback">
                                        Please select an image.
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Contact Person Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="contact_name"
                                           required value="{{ $event->contact_name ?? old('contact_name') }}">
                                    <div class="invalid-feedback">
                                        Please enter a name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="contact_email" placeholder="Email"
                                           required value="{{ $event->contact_email ?? old('contact_email') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Phone No</label>
                                    <input type="number" class="form-control" name="contact_phone_number"
                                           placeholder="Phone No" required
                                           value="{{ $event->contact_phone_number ?? old('contact_phone_number') }}">
                                    <div class="invalid-feedback">
                                        Please enter a phone number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($event) && $event->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection

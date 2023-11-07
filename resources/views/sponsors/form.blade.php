@extends('layouts.vertical', ['title' => 'Sponsors', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => $formMode, 'sub_title' => 'Sponsors'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('sponsors.store_update') }}" method="POST" class="needs-validation"
                          novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if(isset($sponsor))
                                <input type="hidden" name="update_id" value="{{ $sponsor->sponsor_id }}">
                            @endif
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Event Name</label>
                                    <input type="text" class="form-control" name="event_name" required placeholder="Event Name" value="{{ $sponsor->event_name ?? old('event_name') }}">
                                    <div class="invalid-feedback">
                                        Please enter a event name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" required placeholder="Company Name" value="{{ $sponsor->company_name ?? old('company_name') }}">
                                    <div class="invalid-feedback">
                                        Please enter a company name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="sponsor_type_id" class="form-label">Type</label>
                                    <select class="form-select" id="sponsor_type_id" name="sponsor_type_id" required>
                                        <option value="">--SELECT--</option>
                                        @foreach($sponsorTypes as $sponsor_type_id => $sponsor_type)
                                            <option value="{{ $sponsor_type_id }}" @if(isset($sponsor) && ($sponsor->sponsor_type_id == $sponsor_type_id)) selected @endif>{{ $sponsor_type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a sponsor type.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Contact Person Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="contact_name" required value="{{ $sponsor->contact_name ?? old('contact_name') }}">
                                    <div class="invalid-feedback">
                                        Please enter a name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required value="{{ $sponsor->email ?? old('email') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone No</label>
                                    <input type="number" class="form-control" name="mobile_number" placeholder="Phone No" required value="{{ $sponsor->mobile_number ?? old('mobile_number') }}">
                                    <div class="invalid-feedback">
                                        Please enter a phone number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($sponsor) && $sponsor->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection

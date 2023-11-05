@extends('layouts.vertical', ['title' => 'Event Company Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Add', 'sub_title' => 'Event Company Management'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('event_company_management.store_update') }}" method="POST"
                          class="needs-validation"
                          novalidate>
                        @csrf
                        <div class="row">
                            @if(isset($eventCompany))
                                <input type="hidden" name="update_id" value="{{ $eventCompany->event_company_id }}">
                            @endif
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Company Name</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                           placeholder="Company Name" required
                                           value="{{ $eventCompany->title ?? old('title') }}">
                                    <div class="invalid-feedback">
                                        Please enter a company name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" required
                                           class="form-control" placeholder="Email"
                                           value="{{ $eventCompany->email ?? old('email') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" required
                                           class="form-control" placeholder="Address"
                                           value="{{ $eventCompany->address ?? old('address') }}">
                                    <div class="invalid-feedback">
                                        Please enter a address.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone No</label>
                                    <input type="number" id="phone_number" name="phone_number" required
                                           class="form-control" placeholder="Phone No"
                                           value="{{ $eventCompany->phone_number ?? old('phone_number') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="abn_number" class="form-label">ABN No</label>
                                    <input type="text" id="abn_number" name="abn_number"
                                           class="form-control" placeholder="ABN No"
                                           value="{{ $eventCompany->abn_number ?? old('abn_number') }}">
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label for="contact_name" class="form-label">Contact Person Name</label>
                                    <input type="text" id="contact_name" name="contact_name" class="form-control"
                                           required value="{{ $eventCompany->contact_name ?? old('contact_name') }}"
                                           placeholder="Contact Person Name">
                                    <div class="invalid-feedback">
                                        Please enter a contact name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Email</label>
                                    <input type="email" id="contact_email" name="contact_email" required
                                           class="form-control" placeholder="Email"
                                           value="{{ $eventCompany->contact_email ?? old('contact_email') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label for="contact_phone_number" class="form-label">Phone No</label>
                                    <input type="text" id="contact_phone_number" name="contact_phone_number" required
                                           class="form-control" placeholder="Phone No"
                                           value="{{ $eventCompany->contact_phone_number ?? old('contact_phone_number') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                           placeholder="Username" required
                                           value="{{ $eventCompany->username ?? old('username') }}">
                                    <div class="invalid-feedback">
                                        Please enter a username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                               @if($formMode == "Add") required @endif
                                               placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($eventCompany) && $eventCompany->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

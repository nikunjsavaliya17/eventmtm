@extends('layouts.vertical', ['title' => 'Food Partners', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => $formMode, 'sub_title' => 'Food Partners'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('food_partners.store_update') }}" method="POST" class="needs-validation"
                          novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if(isset($foodPartner))
                                <input type="hidden" name="update_id" value="{{ $foodPartner->food_partner_id }}">
                            @endif
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" required
                                           placeholder="Company Name"
                                           value="{{ $foodPartner->company_name ?? old('company_name') }}">
                                    <div class="invalid-feedback">
                                        Please enter a company name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                    @if(isset($foodPartner) && isset($foodPartner->logo))
                                        <img src="{{ getFileUrl($foodPartner->logo, 'food_partner') }}" alt="{{ $foodPartner->logo }}" width="200px">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Contact Person Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="contact_name"
                                           required value="{{ $foodPartner->contact_name ?? old('contact_name') }}">
                                    <div class="invalid-feedback">
                                        Please enter a name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="contact_email" placeholder="Email"
                                           required value="{{ $foodPartner->contact_email ?? old('contact_email') }}">
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
                                           value="{{ $foodPartner->contact_phone_number ?? old('contact_phone_number') }}">
                                    <div class="invalid-feedback">
                                        Please enter a phone number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                           placeholder="Username" required
                                           value="{{ $foodPartner->username ?? old('username') }}">
                                    <div class="invalid-feedback">
                                        Please enter a username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
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
                            <hr>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">ABN Number</label>
                                    <input type="text" class="form-control" name="abn_number"
                                           placeholder="Enter value"
                                           value="{{ $foodPartner->abn_number ?? old('abn_number') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">BSB Number</label>
                                    <input type="text" class="form-control" name="bsb_number"
                                           placeholder="Enter value"
                                           value="{{ $foodPartner->bsb_number ?? old('bsb_number') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name"
                                           placeholder="Enter value"
                                           value="{{ $foodPartner->bank_name ?? old('bank_name') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Bank Account Number</label>
                                    <input type="text" class="form-control" name="bank_account_number"
                                           placeholder="Enter value"
                                           value="{{ $foodPartner->bank_account_number ?? old('bank_account_number') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Account Holder Name</label>
                                    <input type="text" class="form-control" name="bank_account_holder_name"
                                           placeholder="Enter value"
                                           value="{{ $foodPartner->bank_account_holder_name ?? old('bank_account_holder_name') }}">
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($foodPartner) && $foodPartner->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection

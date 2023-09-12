@extends('layouts.vertical', ['title' => 'Event Company Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Add', 'sub_title' => 'Event Company Management'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Company Name</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Email</label>
                                    <input type="email" id="example-email" name="example-email"
                                           class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Address</label>
                                    <input type="text" id="example-email" name="example-email"
                                           class="form-control" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Phone No</label>
                                    <input type="text" id="example-email" name="example-email"
                                           class="form-control" placeholder="Phone No">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">ABN No</label>
                                    <input type="text" id="example-email" name="example-email"
                                           class="form-control" placeholder="ABN No">
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Contact Person Name</label>
                                    <input type="text" id="simpleinput" class="form-control"
                                           placeholder="Contact Person Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Email</label>
                                    <input type="email" id="example-email" name="example-email"
                                           class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Username</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Phone No</label>
                                    <input type="text" id="example-email" name="example-email"
                                           class="form-control" placeholder="Phone No">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                               placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection

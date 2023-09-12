@extends('layouts.vertical', ['title' => 'Event Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Add', 'sub_title' => 'Event Management'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Company</label>
                                    <select class="form-select" id="example-select">
                                        <option>--SELECT--</option>
                                        <option>Company 1</option>
                                        <option>Company 2</option>
                                        <option>Company 3</option>
                                        <option>Company 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Event Name</label>
                                    <input type="text" class="form-control" placeholder="Event Name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Description</label>
                                    <textarea name="" id="" rows="3" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="Start-date" class="form-label">Start Date</label>
                                    <input class="form-control" id="Start-date" type="date"
                                           name="date">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="End-date" class="form-label">End Date</label>
                                    <input class="form-control" id="End-date" type="date"
                                           name="date">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Order No</label>
                                    <input type="text" class="form-control" placeholder="Order No">
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
                                    <label for="example-email" class="form-label">Phone No</label>
                                    <input type="text" id="example-email" name="example-email"
                                           class="form-control" placeholder="Phone No">
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

@extends('layouts.vertical', ['title' => 'Sponsorship Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Sponsorship Management'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('sponsorship_management.add') }}" class="btn btn-success rounded-pill">Add
                                New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Type</th>
                                <th>Company Name</th>
                                <th>Active</th>
                                <th>Display Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Sponsor Event 1
                                </td>
                                <td>Sponsor Type 2</td>
                                <td class="table-user">
                                    <img src="{{ asset('images/users/avatar-2.jpg') }}" alt="table-user" class="me-2 rounded-circle">
                                    Test Company
                                </td>
                                <td>Yes</td>
                                <td>1</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    Sponsor Event 1
                                </td>
                                <td>Sponsor Type 1</td>
                                <td class="table-user">
                                    <img src="{{ asset('images/users/avatar-2.jpg') }}" alt="table-user" class="me-2 rounded-circle">
                                    Test Company
                                </td>
                                <td>Yes</td>
                                <td>2</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/tabledit.init.js'])
@endsection

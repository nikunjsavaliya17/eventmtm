@extends('layouts.vertical', ['title' => 'Event Company Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Event Company Management'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('event_company_management.add') }}" class="btn btn-success rounded-pill">Add
                                New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="table-user">
                                    Company 1
                                </td>
                                <td>test@gmail.com</td>
                                <td>9998884477</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    Company 2
                                </td>
                                <td>test1@gmail.com</td>
                                <td>9998884477</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    Company 3
                                </td>
                                <td>test2@gmail.com</td>
                                <td>9998884477</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    Company 4
                                </td>
                                <td>test3@gmail.com</td>
                                <td>9998884477</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card body-->
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    @vite(['resources/js/pages/tabledit.init.js'])
@endsection
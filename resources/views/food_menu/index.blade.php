@extends('layouts.vertical', ['title' => 'Food Menu', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Food Menu'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('food_menu.add') }}" class="btn btn-success rounded-pill">Add
                                New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>SKU</th>
                                <th>Active</th>
                                <th>Display Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="table-user">
                                    <img src="{{ asset('images/users/avatar-2.jpg') }}" alt="table-user" class="me-2 rounded-circle">
                                    Item 1
                                </td>
                                <td>Food Type 1</td>
                                <td>10</td>
                                <td>Yes</td>
                                <td>1</td>
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

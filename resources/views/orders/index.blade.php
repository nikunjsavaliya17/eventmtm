@extends('layouts.vertical', ['title' => 'Orders', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Orders'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>Order No.</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>16/09/2023</td>
                                <td>Food Name</td>
                                <td>₹ 1500.00</td>
                                <td>Pending</td>
                                <td>
                                    <a href="{{ route('orders.detail') }}" class="text-reset fs-16 px-1"> <i
                                            class="ri-eye-line"></i></a>
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

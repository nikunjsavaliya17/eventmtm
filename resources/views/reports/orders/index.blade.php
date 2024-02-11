@extends('layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Orders</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="datatable-basic table" id="listDatatable">
                            <thead>
                            <tr>
                                <th data-orderable="false">Order No</th>
                                <th data-orderable="false" data-searchable="false">Event Name</th>
                                <th data-orderable="false" data-searchable="false">User</th>
                                <th data-orderable="false" data-searchable="false">Amount</th>
                                <th data-searchable="false">Created At</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_scripts')
    <script src="{{ asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/tables/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        var $dataTableList;
        $(document).ready(function () {
            $dataTableList = $('#listDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "drawCallback": function () {
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
                },
                ajax: {
                    url: '{{ route('orders') }}',
                    data: function (d) {
                    }
                },
                "columns": [
                    {data: 'order_no', name: 'order_no'},
                    {data: 'event_title', name: 'eventDetail.title'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'created_at', name: 'created_at'},
                ],
                order: [[4, "desc"]],
            });
        });
    </script>
@endpush

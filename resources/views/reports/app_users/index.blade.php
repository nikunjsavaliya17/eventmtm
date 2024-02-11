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
            <h4 class="card-title">App Users</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="datatable-basic table" id="listDatatable">
                            <thead>
                            <tr>
                                <th data-orderable="false" data-searchable="false">Name</th>
                                <th data-orderable="false">Email</th>
                                <th data-orderable="false">Mobile Number</th>
                                <th data-orderable="false" data-searchable="false">Status</th>
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
                    url: '{{ route('app_users') }}',
                    data: function (d) {
                    }
                },
                "columns": [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                ],
                order: [[4, "desc"]],
            });
        });

        function updateActiveStatus(record_id) {
            Swal.fire({
                title: "Are you sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yes!",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                showLoaderOnConfirm: true,
                preConfirm: false,
                buttonsStyling: false
            }).then(function (t) {
                if (t.value) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('app_users.update_status') }}',
                        data: {
                            pk: record_id,
                            name: 'is_active',
                        },
                        beforeSend: function () {
                            blockUIEnable();
                        },
                        success: function (result) {
                            if (result.status) {
                                toastr['success']("Status Updated Successfully",
                                    'Success', {
                                        showMethod: 'fadeIn',
                                        hideMethod: 'fadeOut',
                                        closeButton: true,
                                        tapToDismiss: false,
                                        progressBar: true,
                                        timeOut: 3000,
                                    });
                            } else {
                                var pageInfo = $dataTableList.page.info();
                                $dataTableList.page(pageInfo.page).draw('page');
                                toastr['error'](result.message, 'Fail', {
                                    showMethod: 'fadeIn',
                                    hideMethod: 'fadeOut',
                                    closeButton: true,
                                    tapToDismiss: false,
                                    progressBar: true,
                                    timeOut: 3000,
                                });
                            }
                            blockUIDisable();
                        }
                    });
                    Swal.isLoading();
                } else {
                    var pageInfo = $dataTableList.page.info();
                    $dataTableList.page(pageInfo.page).draw('page');
                }
            });
        }
    </script>
@endpush

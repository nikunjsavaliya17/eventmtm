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
            <h4 class="card-title">Admin Roles</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="datatable-basic generalDatatable table">
                            <thead>
                            <tr>
                                <th data-orderable="false">Title</th>
                                <th data-orderable="false" data-searchable="false">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if($item->id != 1)
                                        <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-icon btn-primary waves-effect waves-float waves-light">
                                            <i data-feather="edit-2"></i> Permissions
                                        </a>
                                        @else
                                            ---
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
@endpush

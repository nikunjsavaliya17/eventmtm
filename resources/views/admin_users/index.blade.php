@extends('layouts.vertical', ['title' => 'Admin Users', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Admin Users'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('admin_users.add') }}" class="btn btn-success rounded-pill">Add
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
                                <th>Email</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>Yes</td>
                                <td>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                            class="ri-delete-bin-2-line"></i></a>
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

@section('script')
    @vite(['resources/js/pages/tabledit.init.js'])
@endsection

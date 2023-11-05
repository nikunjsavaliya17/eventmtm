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
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $item)
                                <tr>
                                    <td class="table-user">
                                        {{ $item->title }}
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->is_active ? "Yes" : "No" }}</td>
                                    <td>
                                        <a href="{{ route('event_company_management.edit', $item->event_company_id) }}"
                                           class="text-reset fs-16 px-1"> <i
                                                class="ri-edit-2-line"></i></a>
                                        <a href="javascript: void(0);" class="text-reset fs-16 px-1 deleteRecord"
                                           data-record_id="{{ $item->event_company_id }}"
                                           data-action_url="{{ route('event_company_management.delete') }}"> <i
                                                class="ri-delete-bin-2-line"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">No Record Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        @if(count($records) > 0)
                            {!! $records->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

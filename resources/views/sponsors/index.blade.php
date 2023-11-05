@extends('layouts.vertical', ['title' => 'Sponsors', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Sponsors'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('sponsors.add') }}" class="btn btn-success rounded-pill">Add
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
                                <th>Contact Detail</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th>Display Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $item)
                                <tr>
                                    <td>{{ $item->company_name }}</td>
                                    <td>
                                        <strong>Name</strong>     : {{ $item->contact_name }}<br>
                                        <strong>Email</strong>    : {{ $item->email }}<br>
                                        <strong>Mobile No</strong>: {{ $item->mobile_number }}<br>
                                    </td>
                                    <td>
                                        Test Company
                                    </td>
                                    <td>{{ $item->is_active ? "Yes" : "No" }}</td>
                                    <td>
                                        <input class="displayOrder form-control" type="number" min="0"
                                               data-record_id="{{ $item->sponsor_id }}" data-action_url="{{ route('sponsors.update_order') }}"
                                               value="{{ $item->display_order }}" style="width: 50% !important;">
                                    </td>
                                    <td>
                                        <a href="{{ route('sponsors.edit', $item->sponsor_id) }}" class="text-reset fs-16 px-1"> <i
                                                class="ri-edit-2-line"></i></a>
                                        <a href="javascript: void(0);" class="text-reset fs-16 px-1deleteRecord" data-record_id="{{ $item->sponsor_id }}" data-action_url="{{ route('sponsors.delete') }}"> <i
                                                class="ri-delete-bin-2-line"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">No Record Found</td>
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

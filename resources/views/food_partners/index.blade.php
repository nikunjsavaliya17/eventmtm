@extends('layouts.vertical', ['title' => 'Food Partners', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Food Partners'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('food_partners.add') }}" class="btn btn-success rounded-pill">Add
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
                                <th>Contact Details</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $item)
                            <tr>
                                <td class="table-user">
                                    <img src="{{ asset('images/users/avatar-2.jpg') }}" alt="table-user" class="me-2 rounded-circle">
                                    {{ $item->company_name }}
                                </td>
                                <td>
                                    <strong>Name</strong>     : {{ $item->contact_name }}<br>
                                    <strong>Email</strong>    : {{ $item->contact_email }}<br>
                                    <strong>Mobile No</strong>: {{ $item->contact_phone_number }}
                                </td>
                                <td>{{ $item->is_active ? "Yes" : "No" }}</td>
                                <td>
                                    <a href="{{ route('food_partners.edit', $item->food_partner_id) }}" class="text-reset fs-16 px-1"> <i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript: void(0);" class="text-reset fs-16 px-1 deleteRecord" data-record_id="{{ $item->food_partner_id }}" data-action_url="{{ route('food_partners.delete') }}"> <i
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
                    </div> <!-- end table-responsive-->
                </div> <!-- end card body-->
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
@endsection

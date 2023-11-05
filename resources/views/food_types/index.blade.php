@extends('layouts.vertical', ['title' => 'Food Types', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])
@section('css')
@endsection
@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Food Types'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                        <div class="page-title-right mt-0">
                            <a href="{{ route('food_types.add') }}" class="btn btn-success rounded-pill">Add
                                New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Active</th>
                                <th>Display Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $item)
                                <tr>
                                    <td class="table-user">
                                        {{ $item->title }}
                                    </td>
                                    <td>{{ $item->is_active ? "Yes" : "No" }}</td>
                                    <td>
                                        <input class="displayOrder form-control" type="number" min="0"
                                               data-record_id="{{ $item->food_type_id }}" data-action_url="{{ route('food_types.update_order') }}"
                                               value="{{ $item->display_order }}" style="width: 20% !important;">
                                    </td>
                                    <td>
                                        <a href="{{ route('food_types.edit', $item->food_type_id) }}"
                                           class="text-reset fs-16 px-1"> <i
                                                class="ri-edit-2-line"></i></a>
                                        <a href="javascript: void(0);" class="text-reset fs-16 px-1 deleteRecord" data-record_id="{{ $item->food_type_id }}" data-action_url="{{ route('food_types.delete') }}"> <i
                                                class="ri-delete-bin-2-line"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">No Record Found</td>
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

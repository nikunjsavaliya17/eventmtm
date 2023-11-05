@extends('layouts.vertical', ['title' => 'Food Types', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => $formMode, 'sub_title' => 'Food Types'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('food_types.store_update') }}" method="POST" class="needs-validation"
                          novalidate>
                        @csrf
                        <div class="row">
                            @if(isset($foodType))
                                <input type="hidden" name="update_id" value="{{ $foodType->food_type_id }}">
                            @endif
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                           value="{{ $foodType->title ?? old('title') }}" placeholder="Title"
                                           required>
                                    <div class="invalid-feedback">
                                        Please enter a title.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($foodType) && $foodType->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.vertical', ['title' => 'Food Menu', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Add', 'sub_title' => 'Food Menu'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('food_menu.store_update') }}" method="POST" class="needs-validation"
                          novalidate enctype="multipart/form-data">
                        @csrf
                        @if(isset($foodMenu))
                            <input type="hidden" name="update_id" value="{{ $foodMenu->food_menu_id }}">
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Food Name</label>
                                    <input type="text" class="form-control" name="title" required
                                           placeholder="Food Name" value="{{ $foodMenu->title ?? old('title') }}">
                                    <div class="invalid-feedback">
                                        Please enter a title.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Food Image</label>
                                    <input type="file" class="form-control" name="image"
                                           @if(!isset($foodMenu)) required @endif>
                                    <div class="invalid-feedback">
                                        Please select an image.
                                    </div>
                                    @if(isset($foodMenu) && isset($foodMenu->image))
                                        <img src="{{ getFileUrl($foodMenu->image, 'food_menu') }}" alt="{{ $foodMenu->image }}" width="200px">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3"
                                              required>{{ $foodMenu->description ?? old('description') }}</textarea>
                                    <div class="invalid-feedback">
                                        Please enter a description.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="food_type_id" class="form-label">Food Type</label>
                                    <select class="form-select" id="food_type_id" name="food_type_id" required>
                                        <option value="">--SELECT--</option>
                                        @foreach($foodTypes as $food_type_id => $food_type)
                                            <option value="{{ $food_type_id }}"
                                                    @if(isset($foodMenu) && $foodMenu->food_type_id == $food_type_id) selected @endif>{{ $food_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">SKU</label>
                                    <input type="number" class="form-control" name="sku" required
                                           placeholder="Enter sku" value="{{ $foodMenu->sku ?? old('sku') }}">
                                    <div class="invalid-feedback">
                                        Please enter a valid number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Ingredients</label>
                                    <textarea name="ingredients" class="form-control"
                                              rows="3">{{ $foodMenu->ingredients ?? old('ingredients') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Other Details</label>
                                    <textarea name="other_details" class="form-control"
                                              rows="3">{{ $foodMenu->other_details ?? old('other_details') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($foodMenu) && $foodMenu->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection

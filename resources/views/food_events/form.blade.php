@extends('layouts.vertical', ['title' => 'Food Events', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => $formMode, 'sub_title' => 'Food Events'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('food_events.store_update') }}" method="POST" class="needs-validation"
                          novalidate>
                        @csrf
                        <div class="row">
                            @if(isset($foodEvent))
                                <input type="hidden" name="update_id" value="{{ $foodEvent->food_partner_event_id }}">
                            @endif
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Event Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                           value="{{ $foodEvent->title ?? old('title') }}" placeholder="Title"
                                           required>
                                    <div class="invalid-feedback">
                                        Please enter a title.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="food_partner_id" class="form-label"> Food Partner</label>
                                    <select class="form-select" id="food_partner_id" name="food_partner_id" required>
                                        <option value="">--SELECT--</option>
                                        @foreach($foodPartners as $food_partner_id => $food_partner)
                                            <option value="{{ $food_partner_id }}"
                                                    @if(isset($foodEvent) && ($foodEvent->food_partner_id == $food_partner_id)) selected @endif>{{ $food_partner }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a food partner.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                               @if(isset($foodEvent) && $foodEvent->is_active) checked @endif>
                                        <label class="form-check-label form-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
@endsection

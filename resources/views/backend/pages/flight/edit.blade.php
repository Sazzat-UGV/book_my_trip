@extends('backend.layout.master')
@section('title')
    Flight Create
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Flight Create'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('flight.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Flight List</a>
                        </div>

                        <form action="{{ route('flight.update',$flight->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>Airlines Name<span class="text-danger">*</span></label>
                                    <input type="text" name="airlines_name" value="{{ $flight->airlines_name }}"
                                        placeholder="Enter airlines name"
                                        class="form-control @error('airlines_name')
                                is-invalid
                                @enderror">
                                    @error('airlines_name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="airlines_model">Airlines Model<span class="text-danger">*</span></label>
                                    <input type="text"  id="airlines_model" name="airlines_model"
                                        value="{{ $flight->airlines_model }}" placeholder="Enter airlines model"
                                        class="form-control @error('airlines_model')
                                    is-invalid
                                    @enderror">
                                    @error('airlines_model')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="departure_time">Departure Time<span class="text-danger">*</span></label>
                                    <input type="time" id="departure_time" name="departure_time"
                                        value="{{ $flight->departure_time }}"
                                        class="form-control @error('departure_time')
                                    is-invalid
                                    @enderror">
                                    @error('departure_time')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="from">From<span class="text-danger">*</span></label>
                                    <input type="text" id="from" name="from" value="{{ $flight->from }}"
                                        class="form-control @error('from')
                                    is-invalid
                                    @enderror">
                                    @error('from')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="to">To<span class="text-danger">*</span></label>
                                    <input type="text" id="to" name="to" value="{{ $flight->to }}"
                                        class="form-control @error('to')
                                    is-invalid
                                    @enderror">
                                    @error('to')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="total_sit">Total Sit<span class="text-danger">*</span></label>
                                    <input type="number" min="1" id="total_sit" name="total_sit" value="{{ $flight->total_sit }}"
                                        class="form-control @error('total_sit')
                                    is-invalid
                                    @enderror">
                                    @error('total_sit')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="available_sit">Available Sit<span class="text-danger">*</span></label>
                                    <input type="number" min="0" id="available_sit" name="available_sit"
                                        value="{{ $flight->available_sit }}"
                                        class="form-control @error('available_sit')
                                    is-invalid
                                    @enderror">
                                    @error('available_sit')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="price">Price<span class="text-danger">*</span></label>
                                    <input type="number" min="1" id="price" name="price" value="{{ $flight->price }}"
                                        class="form-control @error('price')
                                    is-invalid
                                    @enderror">
                                    @error('price')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="flight_date">Flight Date<span class="text-danger">*</span></label>
                                    <input type="date" id="flight_date" name="flight_date"
                                        value="{{ $flight->flight_date }}"
                                        class="form-control @error('flight_date')
                                    is-invalid
                                    @enderror">
                                    @error('flight_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>


                            </div>
                            <button class="btn btn-warning" type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
@endpush

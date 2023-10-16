@extends('backend.layout.master')
@section('title')
    Hotel Edit
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Hotel Edit'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('hotel.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Hotel List</a>
                        </div>

                        <form action="{{ route('hotel.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>Hotel Name<span class="text-danger">*</span></label>
                                    <input type="text" name="hotel_name" value="{{ $hotel->hotel_name }}"
                                        placeholder="Enter hotel name"
                                        class="form-control @error('hotel_name')
                                is-invalid
                                @enderror">
                                    @error('hotel_name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="hotel_location">Hotel Location<span class="text-danger">*</span></label>
                                    <input type="text" min="1" id="hotel_location" name="hotel_location"
                                        value="{{ $hotel->hotel_location }}" placeholder="Enter hotel location"
                                        class="form-control @error('hotel_location')
                                    is-invalid
                                    @enderror">
                                    @error('hotel_location')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="room_price">Hotel Price<span class="text-danger">*</span></label>
                                    <input type="text" id="room_price" name="room_price"
                                        value="{{ $hotel->room_price }}" placeholder="Enter hotel price"
                                        class="form-control @error('room_price')
                                    is-invalid
                                    @enderror">
                                    @error('room_price')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="hotel_rating">Rating<span class="text-danger">*</span></label>
                                    <input type="number" max="5" placeholder="Enter hotel rating" min="0"
                                        id="hotel_rating" name="hotel_rating" value="{{ $hotel->hotel_rating }}"
                                        class="form-control @error('hotel_rating')
                                    is-invalid
                                    @enderror">
                                    @error('hotel_rating')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="room_type">Room Type<span class="text-danger">*</span></label>
                                    <input type="text" id="room_type" name="room_type" placeholder="Enter room type"
                                        value="{{ $hotel->room_type }}"
                                        class="form-control @error('room_type')
                                    is-invalid
                                    @enderror">
                                    @error('room_type')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Hotel Details<span class="text-danger">*</span></label>
                                    <textarea name="hotel_details" id="editor" cols="30" rows="5"
                                        class="form-control @error('hotel_details')
                                is-invalid
                                @enderror"
                                        placeholder="Enter package details">{{ $hotel->hotel_details }}</textarea>
                                    @error('hotel_details')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Hotel Image (780*420)<span class="text-danger">*</span></label>
                                    <input type="file" name="hotel_image"
                                        data-default-file="{{ asset('uploads/hotel') }}/{{ $hotel->hotel_image }}"
                                        class="form-control dropify @error('hotel_image')
                                is-invalid
                                @enderror">
                                    @error('hotel_image')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="hotel_multiple_image">
                                        Hotel Multiple Image (200*200)<span class="text-danger">*</span>
                                    </label>
                                    <input type="file" multiple name="hotel_multiple_image[]"
                                        class=" form-control p-1 @error('hotel_multiple_image')
                                        is-invalid
                                        @enderror">
                                    @error('hotel_multiple_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop your image here or click',
            }
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush

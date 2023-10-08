@extends('backend.layout.master')
@section('title')
    Slider Edit
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Slider Edit'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('slider.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Slider List</a>
                        </div>

                        <form action="{{ route('slider.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Slider Heading<span class="text-danger">*</span></label>
                                <input type="text" name="slider_heading" value="{{ $slider->slider_heading }}"
                                    placeholder="Enter slider heading"
                                    class="form-control @error('slider_heading')
                                is-invalid
                                @enderror">
                                @error('slider_heading')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Slider Details<span class="text-danger">*</span></label>
                                <textarea name="slider_details" id="" cols="30" rows="5"
                                    class="form-control @error('slider_details')
                                is-invalid
                                @enderror"
                                    placeholder="Enter slider details">{{ $slider->slider_details }}</textarea>
                                @error('slider_details')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Slider Image (1600*600)<span class="text-danger">*</span></label>
                                <input type="file" name="slider_image"
                                    data-default-file="{{ asset('uploads/slider') }}/{{ $slider->slider_image }}"
                                    class="form-control dropify @error('slider_image')
                                is-invalid
                                @enderror">
                                @error('slider_image')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Save Changes</button>
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

    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop your image here or click',
            }
        });
    </script>
@endpush

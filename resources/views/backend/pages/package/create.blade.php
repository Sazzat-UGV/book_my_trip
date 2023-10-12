@extends('backend.layout.master')
@section('title')
    Package Create
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Package Create'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('package.index') }}" class=" btn btn-primary shadow-sm"><i
                                    class="fas fa-arrow-left text-white-50"></i> Back to Package List</a>
                        </div>

                        <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col-12 mb-3">
                                    <label>Select Category<span class="text-danger">*</span></label>
                                    <select class="custom-select @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        <option value="">Select a category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Package Name<span class="text-danger">*</span></label>
                                    <input type="text" name="package_name" value="{{ old('package_name') }}"
                                        placeholder="Enter package name"
                                        class="form-control @error('package_name')
                                is-invalid
                                @enderror">
                                    @error('package_name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="package_period">Package Period (DAY)<span
                                            class="text-danger">*</span></label>
                                    <input type="number" min="1" id="package_period" name="package_period"
                                        value="{{ old('package_period') }}" placeholder="Enter package period"
                                        class="form-control @error('package_period')
                                    is-invalid
                                    @enderror">
                                    @error('package_period')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="package_price">Package Price<span class="text-danger">*</span></label>
                                    <input type="text" id="package_price" name="package_price"
                                        value="{{ old('package_price') }}" placeholder="Enter package price"
                                        class="form-control @error('package_price')
                                    is-invalid
                                    @enderror">
                                    @error('package_price')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="package_rating">Rating<span class="text-danger">*</span></label>
                                    <input type="number" max="5" placeholder="Enter package rating" min="0"
                                        id="package_rating" name="package_rating" value="{{ old('package_rating') }}"
                                        class="form-control @error('package_rating')
                                    is-invalid
                                    @enderror">
                                    @error('package_rating')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="starting_date">Starting Date<span class="text-danger">*</span></label>
                                    <input type="date" id="starting_date" name="starting_date"
                                        value="{{ old('starting_date') }}"
                                        class="form-control @error('starting_date')
                                    is-invalid
                                    @enderror">
                                    @error('starting_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="ending_date">Ending Date<span class="text-danger">*</span></label>
                                    <input type="date" id="ending_date" name="ending_date"
                                        value="{{ old('ending_date') }}"
                                        class="form-control @error('ending_date')
                                    is-invalid
                                    @enderror">
                                    @error('ending_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="start_from">Start From<span class="text-danger">*</span></label>
                                    <input type="text" id="start_from" name="start_from" value="{{ old('start_from') }}"
                                        class="form-control @error('start_from')
                                    is-invalid
                                    @enderror">
                                    @error('start_from')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Package Details<span class="text-danger">*</span></label>
                                    <textarea name="package_details" id="editor" cols="30" rows="5"
                                        class="form-control @error('package_details')
                                is-invalid
                                @enderror"
                                        placeholder="Enter package details">{{ old('package_details') }}</textarea>
                                    @error('package_details')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Package Image (780*420)<span class="text-danger">*</span></label>
                                    <input type="file" name="package_image"
                                        class="form-control dropify @error('package_image')
                                is-invalid
                                @enderror">
                                    @error('package_image')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="package_multiple_image">
                                        Package Multiple Image (200*200)<span class="text-danger">*</span>
                                    </label>
                                    <input type="file" multiple name="package_multiple_image[]"
                                        class=" form-control p-1 @error('package_multiple_image')
                                        is-invalid
                                        @enderror">
                                    @error('package_multiple_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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

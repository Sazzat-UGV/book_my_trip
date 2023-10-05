@extends('backend.layout.master')
@section('title')
    Dashboard
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Dashboard'])
    <div class="container">
    <div class="row">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati eum veniam asperiores error modi dignissimos, cumque nihil consectetur eaque tenetur!
    </div>
    </div>
@endsection
@push('admin_script')
@endpush

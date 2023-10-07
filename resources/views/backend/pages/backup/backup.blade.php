@extends('backend.layout.master')
@section('title')
    Database Backup List
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('backend.layout.inc.breadcump', ['page_name' => 'Database Backup List'])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @can('backup-create')
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary me-4"
                                    onclick="event.preventDefault(); document.getElementById('new-backup-form').submit();"> <i
                                        class="fas fa-plus-circle"></i> Create New Backup</button>
                                <form action="{{ route('backup.store') }}" method="post" class="d-none" id="new-backup-form">
                                    @csrf
                                </form>
                            </div>
                        @endcan
                        <div class="table-responsive text-nowrap my-3">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Last Updated</th>
                                        <th>File Name</th>
                                        <th>File Size</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($backups as $index => $backup)
                                        <tr>
                                            <td><strong>{{ $index + 1 }}</strong></td>
                                            <td>{{ $backup['created_at'] }}</td>
                                            <td>{{ $backup['file_name'] }}</td>
                                            <td>{{ $backup['file_size'] }}</td>
                                            <td class="text-right">
                                                <div class="actions d-flex justify-content-start">
                                                    @can('backup-download')
                                                        <div class="actions">
                                                            <a class="btn btn-sm btn-outline-dark mr-1"
                                                                href="{{ route('admin.backupDownload', $backup['file_name']) }}"><i
                                                                    class="fas fa-download"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('backup-delete')
                                                        <div class="actions">
                                                            <form action="{{ route('backup.destroy', $backup['file_name']) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class=" btn btn-sm btn-outline-danger show_confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                pagingType: 'first_last_numbers',
            });

            $('.show_confirm').click(function(event) {
                let form = $(this).closest('form');
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })



        });
    </script>
@endpush

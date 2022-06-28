@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <a href="{{ route('subjects.create') }}" class="btn btn-outline-primary">Thêm mới</a>
        <table id="subject-table" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Tín chỉ</th>
                    <th>Khoa</th>
                    <th>Quản trị</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.min.js') }}"></script>
    <script>
        $(function() {
            let table = $('#subject-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('student.api') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'credit',
                            name: 'credit'
                        },
                        {
                            data: 'faculty_name',
                            name: 'faculty_name'
                        },
                    },
                ]
            });

        $(document).on('click', '.btn-delete', function() {
            let row = $(this).parents('tr');
            let form = $(this).parents('form');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                success: function(res) {
                    alert(res['message']);
                    table.draw();
                },
                error: function() {
                    alert('Error');
                },
            });
        });
        });
    </script>
@endpush

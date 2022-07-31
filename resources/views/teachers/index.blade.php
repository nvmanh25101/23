@extends('layouts.master')
@push('css')
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <a href="{{ route('teachers.create') }}" class="btn btn-outline-primary">Thêm mới</a>

        <label class="btn btn-info mb-0" id="import-btn">
            Nhập CSV
        </label>
        <form method="post" action="{{ route('teachers.import_csv' ) }}" enctype="multipart/form-data" class="d-none" id="import-form">
            @csrf
            <input type="file" name="file"
                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
        <table id="data-table" class="table table-striped dt-responsive nowrap w-100">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                {{--                <th>Thông tin</th>--}}
                <th>Khoa</th>
                <th>Chức vụ</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
                <th>Xóa</th>
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
        var CSRF_TOKEN = document.querySelector('meta[name="csrf_token"]').getAttribute("content");

        $(document).ready(function () {
            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('teachers.api') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    // {data: 'infor', name: 'infor'},
                    {data: 'faculty_name', name: 'faculty_name'},
                    {data: 'level', name: 'level'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'edit',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}"><i class='mdi mdi-pencil'></i></a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete btn btn-danger"><i class='mdi mdi-delete'></i></button>
                        </form>`;
                        }
                    },
                ]
            });

            $(document).on('click', '.btn-delete', function () {
                let row = $(this).parents('tr');
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function (res) {
                        alert(res['message']);
                        table.draw();
                    },
                    error: function () {
                        alert('Error');
                    },
                });
            });

            $('#import-btn').on('click', function () {
                $('#import-form').toggleClass('d-none');
            });
            {{--$("#csv").change(function () {--}}
            {{--    let formData = new FormData();--}}
            {{--    formData.append('file', $(this)[0].files[0]);--}}
            {{--    formData.append('_token',CSRF_TOKEN);--}}

            {{--    $.ajax({--}}
            {{--        url: '{{ route('teachers.import_csv') }}',--}}
            {{--        type: 'POST',--}}
            {{--        dataType: 'json',--}}
            {{--        data: formData,--}}
            {{--        async: false,--}}
            {{--        cache: false,--}}
            {{--        contentType: false,--}}
            {{--        processData: false,--}}
            {{--        success: function () {--}}
            {{--            $.toast({--}}
            {{--                heading: 'Nhập dữ liệu thành công',--}}
            {{--                text: 'Dữ liệu đã được nhập',--}}
            {{--                showHideTransition: 'slide',--}}
            {{--                position: 'bottom-right',--}}
            {{--                icon: 'success'--}}
            {{--            })--}}
            {{--        },--}}
            {{--        error: function (response) {--}}

            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@endpush
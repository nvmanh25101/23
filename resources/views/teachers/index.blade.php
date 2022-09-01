@extends('layouts.master')
@push('css')
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-4 d-flex mb-1">
        <label>Chức vụ</label>
        <select class="form-control" id="select-level">
            <option value="-1">Tất cả</option>
            @foreach($arrTeacherLevel as $key => $value)
                <option value="{{ $value }}">
                    {{ $key }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-4 d-flex mb-1">
        <label>Trạng thái</label>
        <select class="form-control" id="select-status">
            <option value="-1">Tất cả</option>
            @foreach($arrTeacherStatus as $key => $value)
                <option value="{{ $value }}">
                    {{ $key }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-4">
        <select class="form-control" id="select-faculty-name"></select>
    </div>

    <div class="col-12">
        <a href="{{ route('teachers.create') }}" class="btn btn-outline-primary">Thêm mới</a>

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-csv">Import CSV</button>

        <!-- Modal -->
        <div id="modal-csv" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import CSV</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        {{--                        <form method="post" action="{{ route('teachers.import_csv' ) }}" enctype="multipart/form-data" id="import-csv">--}}
                        {{--                            @csrf--}}
                        <div class="">
                            <a class="btn btn-info" href="https://docs.google.com/spreadsheets/d/e/2PACX-1vSIPyKDBCXttPO2HfcXmu9BMe2oUtS8Ihj7CGjpDQYjvAgX9HX1tOy_Tt4LrLwMMKPaV0vSSexKwHPL/pubhtml" target="_blank">Xem trước</a>
                        </div>

                        <label class="font-24 mt-2" for="csv">File</label>
                        <div class="col-12 p-0">
                            <input type="file" name="file" id="csv"
                                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                        <div class="col-12 mt-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="btn-import">Import</button>
                        </div>
{{--                        </form>--}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf_token"]').getAttribute("content");
        $("#select-faculty-name").select2({
            ajax: {
                url: "{{ route('loadFacultyName') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            },
            allowClear: true,
            placeholder: 'Chọn Khoa',
        });

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
                        $.toast({
                            heading: res.success,
                            text: 'Dữ liệu đã được nhập',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        });
                        table.draw();
                    },
                    error: function () {
                        $.toast({
                            heading: 'Lỗi',
                            text: 'Đã xảy ra lỗi. Vui lòng thử lại!',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'danger'
                        });
                    },
                });
            });

            $('#select-level').change(function () {
                let value = this.value;
                table.column(3).search(value).draw();
            });
            $('#select-status').change(function () {
                let value = this.value;
                table.column(4).search(value).draw();
            });

            $('#select-faculty-name').change(function () {
                table.column(2).search(this.value).draw();
            });
            $('#import-btn').on('click', function () {
                $('#import-form').toggleClass('d-none');
            });

            $("#btn-import").click(function () {
                let formData = new FormData();
                formData.append('file', $('#csv')[0].files[0]);
                formData.append('_token',CSRF_TOKEN);

                $.ajax({
                    url: '{{ route('teachers.import_csv') }}',
                    type: 'POST',
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        $.toast({
                            heading: res.success,
                            text: 'Dữ liệu đã được nhập',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        });
                        $('#modal-csv').modal('hide').trigger("reset");
                        table.draw();
                    },
                    error: function (res) {
                        $.toast({
                            heading: res.error,
                            text: 'Đã xảy ra lỗi. Vui lòng thử lại!',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'danger'
                        });
                    }
                });
            });
        });
    </script>
@endpush
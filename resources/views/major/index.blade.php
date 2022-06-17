@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="col-12">
        <div id="majors-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#add-major"><i
                            class="mdi mdi-plus-circle mr-2"></i> Thêm ngành học mới
                    </button>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <div id="fillter" class="d-inline mb-2"></div>
                        <button type="button" class="btn btn-light">Import</button>
                        <button type="button" class="btn btn-light " id="export">Export</button>
                    </div>
                </div><!-- end col-->
            </div>
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-end " id="export_div"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table dt-responsive nowrap" id="major-table">
                        <thead>
                            <tr role="row">
                                <th>#ID</th>
                                <th>Khoa</th>
                                <th>Tên ngành</th>
                                <th>Ngày thành lập</th>
                                <th>Quản trị</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- add --}}
        <div id="add-major" class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('major.store') }}" class="pl-3 pr-3" method="post" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên ngành học</label>
                                <input class="form-control" type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="faculty">Chọn khoa</label>
                                <select class="form-control faculty_id" id="faculty" name="faculty_id" required>
                                    <option></option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center ">
                                <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- update --}}
        <div id="update-major" class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('major.update') }}" class="pl-3 pr-3" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="id" class="major-id">
                            <div class="form-group">
                                <label for="major-name">Tên ngành học</label>
                                <input class="form-control" type="text" id="major-name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="faculty_id">Chọn khoa</label>
                                <select class="form-control faculty_id" name="faculty_id" id="faculty_id" required>
                                    <option></option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" data-id="{{ $faculty->id }}">
                                            {{ $faculty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center ">
                                <button class="btn btn-primary w-100" type="submit">Sửa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- delete --}}
        <div id="confirm-delete" class="modal fade form-modal" tabindex="-1" role="dialog"
            aria-labelledby="confirm-deleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-danger">
                        <h4 class="modal-title" id="confirm-deleteLabel">Xác nhận xóa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Bạn chắc chắn với điều này?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('major.destroy') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" class="major-id">
                            <button type="submit" class="btn btn-danger" id="confirm-delete-button">Xóa</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#major-table').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: "{{ route('major.api') }}",
                dom: "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>tipr",
                buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copy',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        text: 'In',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '',
                    }
                ],
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: [-1],
                }],
                columns: [{
                        data: 'id',

                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'faculty',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'action',
                    },
                ],
                order: [
                    [0, 'desc']
                ],
                drawCallback: function(settings) {
                    let button = $("button.btn.action-icon");
                    button.click(function(e) {
                        let id = $(this).attr('data-id');
                        $.ajax({
                            type: "GET",
                            url: "{{ route('major.show') }}/" + id,
                            success: function(response) {
                                $('#major-name').val(response.major.name);
                                $('.major-id').val(response.major.id);
                                $('#faculty_id').val(response.major.faculty_id);
                                $('#faculty_id').trigger('change');
                            },
                            error: function(response) {
                                $('#major-name').val('');
                                $('.major-id').val('');
                                $.toast({
                                    heading: 'Thông báo',
                                    text: 'Có lỗi xảy ra',
                                    icon: 'error',
                                    loader: true,
                                    loaderBg: 'rgba(0,0,0,0.2)',
                                    position: 'top-right',
                                    showHideTransition: 'slide',
                                })
                            },
                        });
                    });
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let button = $("#major-table_wrapper > .dt-buttons");
            $('.buttons-colvis').addClass('btn-success');
            $('.buttons-colvis').append('<i class="mdi mdi-settings"></i>');
            $('.buttons-colvis').parent().appendTo('#fillter');
            button.appendTo('#export_div');
            let wrapButton = button.parent().parent();
            wrapButton.css('display', 'none')
            $('#export').click(function(e) {
                wrapButton.slideToggle()
                e.preventDefault();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let validator = $('.form-modal')
            validator.jbvalidator({
                errorMessage: true,
                successClass: true,
            });
            let select = validator.find('select');
            if (select.val() == null) {
                return false;
            }
            $('.faculty_id').select2({
                placeholder: "Chọn khoa",
            });
        });
    </script>
    @if (session('success'))
        <script>
            $.toast({
                heading: 'Thông báo',
                text: '{{ session('success') }}',
                icon: 'success',
                loader: true,
                loaderBg: 'rgba(0,0,0,0.2)',
                position: 'top-right',
                showHideTransition: 'slide',
            })
        </script>
    @endif
@endpush

@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="col-12">
        <div id="classrooms-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#add-classroom"><i
                            class="mdi mdi-plus-circle mr-2"></i> Thêm lớp học mới
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
                <div class="col-12 d-flex justify-content-end" id="export_div"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table dt-responsive nowrap" id="classroom-table">
                        <thead>
                            <tr role="row">
                                <th>#ID</th>
                                <th>Lớp</th>
                                <th>Tên ngành</th>
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
        <div id="add-classroom" class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('classroom.store') }}" class="pl-3 pr-3" method="post" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Hệ đào tạo</label>
                                <select name="training_id" id="training_id" class="form-control">
                                    @foreach ($trainings as $training)
                                        <option value="{{ $training->id }}" data-code="{{ $training->code }}">
                                            {{ $training->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="yaer">Khóa</label>
                                <select name="academic_year_id " id="year" class="form-control">
                                    <option value="{{ $academicYear->id }}" data-code="K{{ $academicYear->id }}">
                                        {{ $academicYear->name }}
                                        (K{{ $academicYear->id }})
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="major">Chọn ngành</label>
                                <select class="form-control major_id" id="major" name="major_id" required>
                                    <option></option>
                                    @foreach ($majors as $major)
                                        <option value="{{ $major->id }}" data-code="{{ $major->code }}">
                                            {{ $major->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Tên lớp học</label>
                                <input class="form-control" type="text" id="name" name="name" required>
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
        <div id="update-classroom" class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('classroom.update') }}" class="pl-3 pr-3" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="id" class="classroom-id">
                            <div class="form-group">
                                <label for="classroom-name">Tên lớp học</label>
                                <input class="form-control" type="text" id="classroom-name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="major_id">Chọn ngành</label>
                                <select class="form-control major_id" name="major_id" id="major_id" required>
                                    @foreach ($majors as $major)
                                        <option value="{{ $major->id }}" data-id="{{ $major->id }}">
                                            {{ $major->name }}
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
                        <form action="{{ route('classroom.destroy') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" class="classroom-id">
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
            var table = $('#classroom-table').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: "{{ route('classroom.api') }}",
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
                        data: 'major',
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
                            url: "{{ route('classroom.show') }}/" + id,
                            success: function(response) {
                                $('#classroom-name').val(response.classroom.name);
                                $('.classroom-id').val(response.classroom.id);
                                $('#major_id').val(response.classroom
                                    .major_id);
                                $('#major_id').trigger('change');
                            },
                            error: function(response) {
                                $('#classroom-name').val('');
                                $('.classroom-id').val('');
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
            let button = $("#classroom-table_wrapper > .dt-buttons");
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
            $('.major_id').select2({
                placeholder: "Chọn ngành",
            });
            $('#training_id').select2({
                placeholder: "Chọn hệ đào tạo",
            });
        });
    </script>

    <script>
        function renderName(id) {
            $.ajax({
                type: "get",
                url: "{{ route('countClassRoom') }}/" + id,
                success: function(response) {
                    name.val(year.find(':selected')
                        .data(
                            'code') + training_id.find(':selected').data('code') + "-" + major_select
                        .find(
                            ':selected').data(
                            'code') + (response - 0 + 1));
                }
            });
        }

        let major_select = $('#major');
        let name = $('#name');
        let year = $('#year');
        let training_id = $('#training_id');
        major_select.on('select2:select', function(e) {
            let id = major_select.find(':selected').val();
            renderName(id);
        });
        training_id.on('select2:select', function(e) {
            let id = major_select.find(':selected').val();
            renderName(id);
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

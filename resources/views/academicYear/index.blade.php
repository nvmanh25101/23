@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="col-12">
        <div id="academicYears-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#add-academicYear"><i
                            class="mdi mdi-plus-circle mr-2"></i> Thêm niên khoa mới
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
                    <table class="table dt-responsive nowrap" id="academicYear-table">
                        <thead>
                            <tr role="row">
                                <th>#ID</th>
                                <th>Tên khóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="add-academicYear" class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('academicYear.store') }}" class="pl-3 pr-3" method="post" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên khóa</label>
                                <input type="text" id="" class="form-control" readonly
                                    value="Khóa {{ $academicYear + 1 }}">
                            </div>
                            <div class="form-group text-center ">
                                <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div id="update-academicYear" class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('academicYear.update') }}" class="pl-3 pr-3" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="id" class="academicYear-id">
                            <div class="form-group">
                                <label for="year_start">Năm nhập học</label>
                                <input class="form-control" type="text" id="year_start" name="year_start" required
                                    pattern="[0-9]+" title="Only number.">
                            </div>
                            <div class="form-group">
                                <label for="year_total">Tổng số năm đào tạo</label>
                                <input class="form-control" type="text" id="year_total" name="year_total" required
                                    pattern="[0-9]+" title="Only number.">
                            </div>
                            <div class="form-group text-center ">
                                <button class="btn btn-primary w-100" type="submit">Sửa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                        <form action="{{ route('academicYear.destroy') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" class="academicYear-id">
                            <button type="submit" class="btn btn-danger" id="confirm-delete-button">Xóa</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
    {{-- datatable --}}
    <script>
        $(document).ready(function() {
            var table = $('#academicYear-table').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: "{{ route('academicYear.api') }}",
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
                    // {
                    //     data: 'action',
                    // },
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
                            url: "{{ route('academicYear.show') }}/" + id,
                            success: function(response) {
                                $('.academicYear-id').val(response.academicYear.id);
                                $('#year_start').val(response.academicYear
                                    .year_start);
                                $('#year_total').val(response.academicYear
                                    .year_total);
                            },
                            error: function(response) {
                                $('.academicYear-id').val('');
                                $('#year_start').val('');
                                $('#year_total').val('');
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
    {{-- dom position export button --}}
    <script>
        $(document).ready(function() {
            let button = $("#academicYear-table_wrapper > .dt-buttons");
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
    {{-- validate --}}
    <script>
        $(document).ready(function() {
            let validator = $('.form-modal').jbvalidator({
                errorMessage: true,
                successClass: true,
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

@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="col-12">
        <div id="facultys-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#add-faculty"><i
                            class="mdi mdi-plus-circle mr-2"></i> Thêm khoa mới</button>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                        <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                        <button type="button" class="btn btn-light mb-2">Export</button>
                    </div>
                </div><!-- end col-->
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table dt-responsive nowrap" id="faculty-table">
                        <thead>
                            <tr role="row">
                                <th>#ID</th>
                                <th>Tên</th>
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
        <div id="add-faculty" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="margin-top:30vh">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('faculty.store') }}" class="pl-3 pr-3" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="faculty-name">Tên khoa</label>
                                <input class="form-control" type="text" id="faculty-name">
                            </div>
                            <div class="form-group text-center ">
                                <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                            </div>
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
    <script>
        $(document).ready(function() {
            $('#faculty-table').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: "{{ route('faculty.api') }}",
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'created_at',
                    },
                ]
            });
        });
    </script>
@endpush

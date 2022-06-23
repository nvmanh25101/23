@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <a href="{{ route('teachers.create') }}" class="btn btn-outline-primary">Thêm mới</a>
        <table id="subject-table" class="table table-striped dt-responsive nowrap w-100">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Thông tin</th>
                <th>Ngành</th>
                <th>Chức vụ</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Nguyen Van A</td>
                <td>
                    Nam - 01/01/2022
                    <br>
                    0923189479
                    <br>
                    Thanh Xuân - Hà Nội
                </td>
                <td>
                    Công nghệ thông tin
                    <br>
                    Kỹ thuật phần mềm
                </td>
                <td>
                    Giảng viên
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('teachers.edit', 1) }}"><i class='mdi mdi-pencil'></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.min.js') }}"></script>
@endpush
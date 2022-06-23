@extends('layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('teachers.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="form-group col-8">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" name="name" placeholder="Họ và tên" required>
                </div>
                <div class="form-group col-4">
                    <label>Giới tính</label>
                    <select class="form-control" name="gender">
                        <option>Nam</option>
                        <option>Nữ</option>
                    </select>
                </div>
            </div>


            <div class="form-group mb-3">
                <label>Ngày sinh</label>
                <input type="text" class="form-control" name="birthdate" data-provide="datepicker"
                       data-date-autoclose="true">
            </div>
            <div class="row">
                <div class="form-group col-8">
                    <label>Địa chỉ thường trú</label>
                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ" required>
                </div>

                <div class="form-group col-4">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Khoa</label>
                    {{--                <select class="form-control" name="faculty_id">--}}
                    {{--                    @foreach($faculties as $faculty)--}}
                    {{--                        <option value="{{ $faculty->id }}">--}}
                    {{--                            {{ $faculty->name }}--}}
                    {{--                        </option>--}}
                    {{--                    @endforeach--}}
                    {{--                </select>--}}
                </div>

                <div class="form-group mb-3 col-4">
                    <label>Ngành</label>
                    <select class="js-example-basic-multiple" name="majors[]" multiple="multiple">
                        <option value="AL">Alabama</option>
                        ...
                        <option value="WY">Wyoming</option>
                    </select>
                    {{--                <select class="form-control" name="faculty_id">--}}
                    {{--                    @foreach($faculties as $faculty)--}}
                    {{--                        <option value="{{ $faculty->id }}">--}}
                    {{--                            {{ $faculty->name }}--}}
                    {{--                        </option>--}}
                    {{--                    @endforeach--}}
                    {{--                </select>--}}
                </div>
            </div>

            <button class="btn btn-primary mb-3" type="submit">Thêm</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
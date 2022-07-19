@extends('layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('teachers.update', $teacher) }}" class="needs-validation" id="form-edit" novalidate>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-8">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" name="name" value="{{ $teacher->name }}" required>
                </div>
                <div class="form-group col-4">
                    <label>Giới tính</label>
                    <select class="form-control" name="gender">
                        <option value="1" @if($teacher->name === 1) selected @endif>Nam</option>
                        <option value="0" @if($teacher->name === 0) selected @endif>Nữ</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Ngày sinh</label>
                <input type="date" value="{{ $teacher->date }}" class="form-control birthdate-input" name="birthdate">
            </div>

            <div class="row">
                <div class="form-group col-8">
                    <label>Địa chỉ thường trú</label>
                    <input type="text" class="form-control" name="address" value="{{ $teacher->address }}" required>
                </div>

                <div class="form-group col-4">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ $teacher->phone }}" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Khoa</label>
                    <select class="form-control" name="faculty_id">
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Chức vụ</label>
                <select class="form-control" name="level">
                    @foreach($arrTeacherLevel as $option => $value)
                        <option value="{{ $value }}"
                                @if($teacher->level === $value)
                                    selected
                                @endif
                        >
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Trạng thái</label>
                @foreach($arrTeacherStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <input type="radio" name="status" value="{{ $value }}" class="mr-1"
                               @if ($teacher->status === $value)
                                   checked
                                @endif
                        >
                        {{ $option }}
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {

           let birthdate = $('.birthdate-input');
           birthdate.change(function () {
                console.log(birthdate.val());
            });
        });

    </script>
@endpush
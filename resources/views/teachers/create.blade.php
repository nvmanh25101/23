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
                    <input type="text" class="form-control" name="name" placeholder="Họ và tên" value="{{ old('name') }}" required >
                </div>
                <div class="form-group col-4">
                    <label>Giới tính</label>
                    <select class="form-control" name="gender">
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" value="12345678" required>
            </div>

            <div class="form-group mb-3">
                <label>Ngày sinh</label>
                <input  type="date"  class="form-control" name="birthdate" value="{{ old('birthdate') }}">
            </div>
            <div class="row">
                <div class="form-group col-8">
                    <label>Địa chỉ thường trú</label>
                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="{{ old('address') }}" required>
                </div>

                <div class="form-group col-4">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Chức vụ</label>
                <select class="form-control" name="level">
                    @foreach($arrTeacherLevel as $option => $value)
                        <option value="{{ $value }}">
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
                               @if($loop->first)
                                   checked
                                @endif
                        >
                        {{ $option }}
                    </div>
                @endforeach
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
            <button class="btn btn-primary mb-3" type="submit">Thêm</button>
        </form>
    </div>
@endsection
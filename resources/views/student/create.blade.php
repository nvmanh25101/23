@extends('layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('subjects.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="form-group mb-3">
                <label>Tên môn học</label>
                <input type="text" class="form-control" name="name" placeholder="Tên" required>
            </div>

            <div class="form-group mb-3">
                <label>Tín chỉ</label>
                <input type="number" name="credit" class="form-control" required min="1" max="5">
            </div>
            <div class="form-group mb-3">
                <label>Khoa</label>
                <select class="form-control" name="faculty_id">
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}">
                            {{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Thêm</button>
        </form>
    </div>
@endsection
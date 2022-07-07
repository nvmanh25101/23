@extends('layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('subjects.update', $subject) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Tên môn học</label>
                <input type="text" class="form-control" name="name" value="{{ $subject->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Tín chỉ</label>
                <input type="number" name="credit" class="form-control" value="{{ $subject->credit }}" required min="1" max="5">
            </div>
            <div class="form-group mb-3">
                <label>Khoa</label>
                <select class="form-control" name="faculty_id">
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}"
                            @if ($subject->faculty_id === $faculty->id)
                                selected
                            @endif
                        >
                            {{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
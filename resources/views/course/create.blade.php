@extends('layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('course.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="form-group mb-3">
                <label>Chọn khoa</label>
                <select class="form-control" id="faculty_id" name="">
                    <option value=""></option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}">
                            {{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 d-none" id="subject">
                <label>Chọn môn học</label>
                <select class="form-control" id="subject_id" name="subject_id">
                </select>
            </div>
            <div class="form-group mb-3" id="">
                <label>Số buổi học trong tuần</label>
                <select class="form-control" id="" name="weekday">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group mb-3" id="">
                <label>Giáo viên giảng dạy</label>
                <select class="form-control" id="teacher_id" name="teacher_id">
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Thêm</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let faculty_select = $('#faculty_id');
            let subject_select = $('#subject_id');
            let teacher_select = $('#teacher_id');
            faculty_select.select2({
                placeholder: "Chọn khoa",
            });
            faculty_select.change(function(e) {
                let urlLoadSubject = "{{ route('loadSubject') }}/" + $(this).val()
                let urlLoadTeacher = "{{ route('loadTeacher') }}/" + $(this).val()
                $.ajax({
                    type: "GET",
                    url: urlLoadSubject,
                    success: function(response) {
                        subject_select.html('')
                        for (let i = 0; i < response.length; i++) {
                            subject_select.append('<option></option>')
                            subject_select.append('<option value="' + response[i].id + '">' +
                                response[
                                    i].name +
                                '</option>');
                        }
                        $('#subject').removeClass('d-none');
                    }
                });
                $.ajax({
                    type: "GET",
                    url: urlLoadTeacher,
                    success: function(response) {
                        teacher_select.html('')
                        for (let i = 0; i < response.length; i++) {
                            teacher_select.append('<option></option>')
                            teacher_select.append('<option value="' + response[i].id + '">' +
                                response[
                                    i].name +
                                '</option>');
                        }
                    }
                });
            });
            subject_select.select2({
                placeholder: "Chọn môn",
            });
            teacher_select.select2({
                placeholder: "Chọn giáo viên",
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

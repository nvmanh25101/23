@extends('layouts.master')
@section('content')
    @push('css')
        <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
    @endpush
    <div class="col-12">
        <form method="post" action="{{ route('course.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="form-group mb-3">
                <label>Mã học phần</label>
                <input type="text" name="" id="" readonly class="form-control"
                    value="{{ $course_code }}">
            </div>
            <div class="form-group mb-3">
                <label>Tên môn học</label>
                <input type="text" name="" id="" readonly class="form-control"
                    value="{{ $course->subject->name }}">
            </div>
            <div class="form-group mb-3">
                <label>Tên giáo viên </label>
                <input type="text" name="" id="" readonly class="form-control"
                    value="{{ $course->teacher->name }}">
            </div>
            <div class="form-group mb-3">
                <label>Số buổi học/tuần</label>
                <input type="text" name="" id="" readonly class="form-control"
                    value="{{ $course->weekday }}">
                {{-- <select class="form-control" id="" name="weekday">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" @if ($course->weekday == $i) selected @endif>
                            {{ $i }}</option>
                    @endfor
                </select> --}}
            </div>
            <div class="form-group mb-3">
                <div>
                    <input type="radio" name="timetable" id="day">
                    <label for="day">Xếp lịch theo ngày</label>
                </div>
                <div>
                    <input type="radio" name="timetable" id="full">
                    <label for="full">Xếp lịch theo học phần</label>
                </div>
            </div>
            <div class="form-group mb-3 d-flex align-items-center  text-center ">
                <div class="flex-fill">
                    <label for="">Ngày học</label>
                    <input type="date" name="" id="" class="form-control" value="">
                </div>
                <div class="flex-fill">
                    <label for="">Tiết bắt đầu</label>
                    <input type="number" name="" id="" class="form-control" value="">
                </div>
                <div class="flex-fill">
                    <label for="">Tổng số tiết học</label>
                    <input type="number" name="" id="" class="form-control" value="">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Thêm</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'Asia/Ho_Chi_Minh',
                initialView: 'dayGridWeek',
                editable: true,
                events: 'https://fullcalendar.io/api/demo-feeds/events.json',
            });
            calendar.render();
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

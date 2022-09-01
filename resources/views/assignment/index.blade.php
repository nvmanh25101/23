@extends('layouts.master')
@section('content')
    @push('css')
        <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
    @endpush
    <div class="col-12">
        <form method="post" action="{{ route('courseDetail.store') }}" novalidate id="form-create">
            @csrf
            <div class="form-group mb-3">
                <label for="course">Mã học phần</label>
                <select name="course_id" id="course" class="form-control" required>
                    <option></option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_code }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-none" id="course_detail">
                <div class="form-group mb-3">
                    <label>Tên môn học</label>
                    <input type="text" name="" id="subject_name" readonly class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Tên giáo viên </label>
                    <input type="text" name="" id="teacher_name" readonly class="form-control">
                    <input type="hidden" name="teacher_id" id="teacher_id" readonly class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Số buổi học/tuần</label>
                    <input type="text" name="" id="weekday" readonly class="form-control">
                </div>
                <div class="form-group mb-3">
                    <div class="form-check">
                        <input type="radio" name="timetable" id="day" value="1" required>
                        <label for="day">Xếp lịch theo ngày</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="timetable" id="courseDetailFull">
                        <label for="courseDetailFull">Xếp lịch toàn học phần</label>
                    </div>
                </div>
                <div id="divCreate">
                </div>
                <button class="btn btn-primary" type="submit">Thêm</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    {{-- <script src="{{ asset('js/validate.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            let course = $('#course')
            let course_detail = $('#course_detail')
            let subject_name = $('#subject_name')
            let teacher_name = $('#teacher_name')
            let teacher_id = $('#teacher_id')
            let courseDetailFull = $('#courseDetailFull')
            let weekday = $('#weekday')
            let selectDay = $('input[name="timetable"]');
            let divCreate = $('#divCreate');
            course.select2({
                placeholder: "Chọn học phần",
            });
            course.change(function(e) {
                $.ajax({
                    type: "get",
                    url: "{{ route('course.show') }}/" + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        course_detail.removeClass('d-none');
                        subject_name.val(response.subject)
                        teacher_name.val(response.teacher_name)
                        teacher_id.val(response.teacher_id)
                        weekday.val(response.weekday)
                        courseDetailFull.val(response.weekday)
                        divCreate.empty();
                        selectDay.prop('checked', false)
                    }
                });
            });
            selectDay.change(function(e) {
                divCreate.empty();
                let today = new Date().toISOString().slice(0, 10);
                for (i = 0; i < $(this).val(); i++) {
                    divCreate.append(`
                    <div class="form-group mb-3 text-center d-flex">
                        <div class="flex-fill form-group">
                            <label for="">Ngày học</label>
                            <input type="date" name="date[${i}]" id="" class="form-control" required min="${today}">
                        </div>
                        <div class="flex-fill form-group">
                            <label for="">Tiết bắt đầu</label>
                            <input type="text" name="lesson_start[${i}]" class="form-control" data-v-min="1" data-v-max="15" required>
                        </div>
                        <div class="flex-fill form-group">
                            <label for="">Tổng số tiết học</label>
                            <input type="text" name="lesson_total[${i}]" class="form-control" data-v-min="1" data-v-max="15" required>
                        </div>
                    </div>`);
                }
            });
        });
    </script>
    <script>
        let validator = $('#form-create').jbvalidator({
            errorMessage: true,
            successClass: true,
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $.toast({
                    heading: 'Thông báo',
                    text: '{{ $error }}',
                    icon: 'error',
                    loader: true,
                    loaderBg: 'rgba(0,0,0,0.2)',
                    position: 'top-right',
                    showHideTransition: 'slide',
                })
            </script>
        @endforeach
    @endif
@endpush

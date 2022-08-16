@extends('layouts.master')
@section('content')
    @push('css')
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet" type="text/css">
    @endpush
    <div class="col-12">
        @foreach ($courseDetails as $courseDetail)
            <div class="form-group mb-3 text-center d-flex">
                <div class="flex-fill form-group">
                    <label for="">1</label>
                    <input type="text" class="form-control">
                </div>
                <div class="flex-fill form-group">
                    <label for="">1</label>
                    <input type="text" class="form-control">
                </div>
                <div class="flex-fill form-group">
                    <label for="">1</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group d-flex align-items-end">
                <div style="max-width:80px;width:100%;">
                    <script>
                        // Khai báo đối tượng Date
                        // console.log();
                        var date = new Date('{{ $courseDetail->date }}');
                        var current_day = date.getDay();
                        // Biến lưu tên của thứ
                        var day_name = '';

                        switch (current_day) {
                            case 0:
                                day_name = "Chủ nhật";
                                break;
                            case 1:
                                day_name = "Thứ hai";
                                break;
                            case 2:
                                day_name = "Thứ ba";
                                break;
                            case 3:
                                day_name = "Thứ tư";
                                break;
                            case 4:
                                day_name = "Thứ năm";
                                break;
                            case 5:
                                day_name = "Thứ sáu";
                                break;
                            case 6:
                                day_name = "Thứ bảy";
                        }

                        document.write(day_name);
                    </script>
                </div>
                <input type="text" class="date form-control"
                    value="{{ Carbon\Carbon::parse($courseDetail->date)->format('d/m/Y') }}">
                <div class="">
                    <input type="text" value="{{ $courseDetail->lesson_start }}" class="form-control">
                </div>
                <div>
                    <input type="text" value="{{ $courseDetail->lesson_total }}" class="form-control">

                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/datetime-picker.js') }}"></script>
    {{-- <script src="{{ asset('js/validate.js') }}"></script> --}}
    <script>
        $(function() {
            $('.date').datepicker();
        });
    </script>
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

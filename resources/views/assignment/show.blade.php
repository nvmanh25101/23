@extends('layouts.master')
@section('content')
    @push('css')
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet" type="text/css">
    @endpush
    <div class="col-12">
        <div class="form-group">
            <input type="hidden" id="start-val" name="startDateOfWeek">
            <input type="date" id="now">
            <input type="hidden" id="end-val" name="endDateOfWeek">
            <button class="btn btn-danger" id="prev">Tuần trước</button>
            <button class="btn btn-danger" id="today">Hiện tại</button>
            <button class="btn btn-danger" id="next">Tuần sau</button>
        </div>
        <div class="accordion custom-accordion" id="assignment">

        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/datetime.min.js') }}"></script>
    <script></script>
    {{-- <script src="{{ asset('js/validate.js') }}"></script> --}}
    <script>
        function format(date) {
            return date.getFullYear() + '-' + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() +
                    1))) +
                '-' + ((date
                        .getDate() > 9) ?
                    date.getDate() : ('0' + date.getDate()))
        }

        function generateDate(operator) {
            moment.updateLocale("en", {
                week: {
                    dow: 1,
                    doy: 7 // First week of year must contain 1 January (7 + 1 - 1)
                }
            });
            let current_date_input = $('#now');
            let start_date_input = $('#start-val');
            let end_date_input = $('#end-val');

            date = current_date_input.val();
            if (operator === "+") {
                date = moment(date).add(7, 'days').format("YYYY-MM-DD");
            } else if (operator === "-") {
                date = moment(date).subtract(7, 'days').format("YYYY-MM-DD");
            } else {
                date = moment(date).format("YYYY-MM-DD");
            }
            startDateOfWeek = moment(date).startOf('week').format("YYYY-MM-DD");
            endDateOfWeek = moment(date).endOf('week').format("YYYY-MM-DD");
            current_date_input.val(date);
            start_date_input.val(startDateOfWeek);
            end_date_input.val(endDateOfWeek);
            return true;
        }

        function render(start, end, teacher_id) {
            let assignment = $('#assignment')
            assignment.html('');
            $.ajax({
                type: "get",
                url: "{{ route('assignment.assigmentsWeekly') }}/" + teacher_id,
                data: {
                    startDateOfWeek: start,
                    endDateOfWeek: end,
                },
                dataType: "json",
                success: function(response) {
                    response.forEach((element, index) => {
                        moment.locale('vi');
                        time = "";
                        if (element.lesson_end <= 6) {
                            time = "Sáng";
                        } else if (element.lesson_end > 6 && element.lesson_end <= 12) {
                            time = 'Chiều';
                        } else {
                            time = "Tối";
                        }
                        date = moment(element.date).format("DD/MM/YYYY (dddd - ") + time + ")";
                        assignment.append(
                            `
                                <div class="accordion custom-accordion" id="custom-accordion-one">
                                    <div class="card mb-0">
                                        <div class="card-header" id="heading${index}">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title collapsed d-block py-1"
                                                    data-toggle="collapse" href="#collapse${index}"
                                                    aria-expanded="false" aria-controls="collapse${index}">
                                                    ${date} <i
                                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapse${index}" class="collapse"
                                            aria-labelledby="heading${index}"
                                            data-parent="#custom-accordion-one">
                                            <div class="card-body text-dark">
                                                <div class="form-group font-weight-bold">
                                                    Lớp: ${element.classroom.name}
                                                </div>
                                                <div class="form-group">
                                                    Môn: ${element.subject.name}
                                                </div>
                                                <div class="form-group">
                                                    Tiết: ${element.lesson_start} - ${element.lesson_end}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            `)
                    });
                },
                error: function(response) {
                    console.log('zxc');
                }
            });
        }

        $(document).ready(function() {
            let current_date_input = $('#now');
            let start_date_input = $('#start-val');
            let end_date_input = $('#end-val');
            var now_date = moment().format("YYYY-MM-DD");
            let teacher_id = "{{ $teacher_id }}";
            current_date_input.val(now_date);
            generateDate()
            render(start_date_input.val(), end_date_input.val(), teacher_id);
            $('#today').click(function(e) {
                current_date_input.val(now_date);
                generateDate()
                render(start_date_input.val(), end_date_input.val(), teacher_id);
            });
            $('#prev').click(function(e) {
                generateDate("-")
                render(start_date_input.val(), end_date_input.val(), teacher_id);
            });
            $('#next').click(function(e) {
                generateDate("+")
                render(start_date_input.val(), end_date_input.val(), teacher_id);
            });
            current_date_input.change(function(e) {
                e.preventDefault();
                generateDate();
                render(start_date_input.val(), end_date_input.val(), teacher_id);
            });
        });
        // console.log(start, startday);
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
                            <input type="date" name="date[${index}]" id="" class="form-control" required min="${today}">
                        </div>
                        <div class="flex-fill form-group">
                            <label for="">Tiết bắt đầu</label>
                            <input type="text" name="lesson_start[${index}]" class="form-control" data-v-min="1" data-v-max="15" required>
                        </div>
                        <div class="flex-fill form-group">
                            <label for="">Tổng số tiết học</label>
                            <input type="text" name="lesson_total[${index}]" class="form-control" data-v-min="1" data-v-max="15" required>
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

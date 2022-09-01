@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-around">
        <form method="post" action="{{ route('assignment.store') }}" class="needs-validation w-50 pr-3" novalidate>
            @csrf
            <div class="form-group">
                <select name="teacher_id" id="teacher_select" class="form-control" required>
                    <option value=""></option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-danger mb-2" id="assignment">Thêm buổi dạy</button>
            <div id="assignment-group"></div>
            <button class="btn btn-primary d-none" type="submit" id="store">Thêm</button>
        </form>
        <div class="calendar w-50 ">
            <div class="timetable">
                <div class="week-names">
                    <div id="1">Thứ 2</div>
                    <div id="2">Thứ 3</div>
                    <div id="3">Thứ 4</div>
                    <div id="4">Thứ 5</div>
                    <div id="5">Thứ 6</div>
                    <div class="weekend" id="6">Thứ 7</div>
                    <div class="weekend" id="0">Chủ Nhật</div>
                </div>
                <div class="time-interval">
                    @for ($i = 1; $i <= 16; $i++)
                        <div>Tiết {{ $i }}</div>
                    @endfor
                </div>
                <div class="content">
                    @for ($i = 1; $i <= 16; $i++)
                        <div class="{{ $i }}" data-date="1"></div>
                        <div class="{{ $i }}" data-date="2"></div>
                        <div class="{{ $i }}" data-date="3"></div>
                        <div class="{{ $i }}" data-date="4"></div>
                        <div class="{{ $i }}" data-date="5"></div>
                        <div class="weekend {{ $i }}" data-date="6"></div>
                        <div class="weekend {{ $i }}" data-date="0"></div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script>
        function dayToNumber(select_date) {
            var date = new Date(select_date);
            var current_day = date.getDay();
            return current_day;
        }

        function dayToName(select_date) {
            var date = new Date(select_date);
            var current_day = date.getDay();
            var day_name = '';
            switch (current_day) {
                case 0:
                    day_name = "Chủ nhật";
                    break;
                case 1:
                    day_name = "Thứ 2";
                    break;
                case 2:
                    day_name = "Thứ 3";
                    break;
                case 3:
                    day_name = "Thứ 4";
                    break;
                case 4:
                    day_name = "Thứ 5";
                    break;
                case 5:
                    day_name = "Thứ 6";
                    break;
                case 6:
                    day_name = "Thứ 7";
            }
            return day_name;
        }

        function findClass() {
            let btn_find = $('.btn-find');
            btn_find.click(function(e) {
                e.preventDefault();
                let group_classroom = $(this).parent().find('.group-classroom');
                let group_subject = $(this).parent().find('.group-subject');
                let date = $(this).parent().find("input[name='date[]']").val();
                let lesson_start = $(this).parent().find("input[name='lesson_start[]']").val()
                let lesson_end = $(this).parent().find("input[name='lesson_end[]']").val()
                let teacher_id = $('#teacher_select').val()
                group_subject.html('');
                $.ajax({
                    type: "get",
                    url: "{{ route('assignment.findClass') }}",
                    data: {
                        date: date,
                        lesson_start: lesson_start,
                        lesson_end: lesson_end,
                        teacher_id: teacher_id
                    },
                    dataType: "json",
                    success: function(response) {
                        let string_select_classroom = '<label>Chọn lớp</label>';
                        string_select_classroom +=
                            '<select name="classroom_id[]" class="form-control classroom_select" required>';
                        string_select_classroom +=
                            `<option value=""></option>`;
                        response.forEach(classroom => {
                            string_select_classroom +=
                                `<option value="${classroom.id}">${classroom.name}</option>`;
                        });
                        string_select_classroom += '</select>';
                        group_classroom.html('');
                        group_classroom.append(string_select_classroom);
                        $('.classroom_select').select2({
                            placeholder: "Chọn lớp",
                        });
                        $('.classroom_select').on('select2:select', function(e) {
                            let classroom_id = $(this).find(':selected').val()
                            $.ajax({
                                type: "get",
                                url: "{{ route('loadPlanFromClassRoom') }}/" +
                                    classroom_id,
                                success: function(response) {
                                    console.log(response);
                                    let string_select_subject =
                                        '<label>Chọn lớp</label>';
                                    string_select_subject +=
                                        '<select name="subject_id[]" class="form-control subject_select" required>';
                                    string_select_subject +=
                                        `<option value=""></option>`;
                                    response.forEach(subject => {
                                        string_select_subject +=
                                            `<option value="${subject.subject_id}">${subject.subject.name}</option>`;
                                    });
                                    string_select_subject += '</select>';
                                    group_subject.html('');
                                    group_subject.append(string_select_subject);
                                    $('.subject_select').select2({
                                        placeholder: "Chọn môn",
                                    });
                                }
                            });
                        });
                    },
                    error: function(response) {
                        group_classroom.html('');
                        $.toast({
                            heading: 'Thông báo',
                            text: response.responseJSON.message,
                            icon: 'error',
                            loader: true,
                            loaderBg: 'rgba(0,0,0,0.2)',
                            position: 'top-right',
                            showHideTransition: 'slide',
                        })
                    }
                });
            });
        }
        $(document).ready(function() {
            let assignment_btn = $('#assignment');
            let group = $('#assignment-group');
            let i = 0;
            let btn_store = $('#store');
            let teacher_select = $('#teacher_select')
            teacher_select.select2({
                placeholder: 'Chọn giáo viên',
            })
            assignment_btn.click(function(e) {
                btn_store.removeClass('d-none');
                i++;
                e.preventDefault();
                group.append(`<div class="accordion custom-accordion mb-1 d-flex justify-content-between align-items-baseline" id="custom-accordion-${i}">
                                <div class="card mb-0 w-100">
                                    <div class="card-header" id="heading${i}">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title collapsed d-block py-1"
                                                data-toggle="collapse" href="#collapse${i}"
                                                aria-expanded="false" aria-controls="collapse${i}">
                                                Buổi ${i} <i
                                                    class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse${i}" class="collapse" aria-labelledby="heading${i}"
                                        data-parent="#custom-accordion-${i}">
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label>Chọn ngày dạy</label>
                                                <span></span>
                                                <input type="date" name="date[]" id="" class="form-control assignment-date" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Tiết bắt đầu <span></span></label>
                                                <input type="text" name="lesson_start[]" id="" class="form-control" value="" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Tiết kết thúc</label>
                                                <input type="text" name="lesson_end[]" id="" class="form-control" value="" required>
                                            </div>
                                            <div class="group-classroom form-group mb-3"></div>
                                            <div class="group-subject form-group mb-3"></div>
                                            <button type="button" class="btn btn-info btn-find">Tìm</button>
                                        </div>
                                    </div>
                                </div>
                                <i class='mdi mdi-close p-2 btn btn-danger ml-2 btn-delete-subject'></i>
                        </div>`);
                let assignment_date = $('.assignment-date');
                assignment_date.change(function(e) {
                    let day = $(this).parent().find('span');
                    day.text('');
                    day.text(`(${dayToName($(this).val())})`);
                });
                findClass();
            });
        });

        $(document).on('click', '.btn-delete-subject', function(e) {
            $(this).parent().remove();
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

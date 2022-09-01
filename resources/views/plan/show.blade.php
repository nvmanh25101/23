@extends('layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('plan.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="form-group mb-3">
                <label>Chọn lớp</label>
                <select class="form-control" id="classroom_select" name="classroom_id" disabled>
                    <option value="">{{ $classroom->name }}</option>
                </select>
            </div>
            <div class=" accordion custom-accordion mb-1" id="custom-accordion-one">
                @foreach ($arr_plan as $key => $plan)
                    <div class="card mb-0">
                        <div class="card-header" id="heading-{{ $key }}">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block py-1" data-toggle="collapse"
                                    href="#collapse{{ $key }}" aria-expanded="false"
                                    aria-controls="collapse{{ $key }}">
                                    Học kỳ {{ $key }}<i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}"
                            data-parent="#custom-accordion-one">
                            <div class="card-body">
                                @foreach ($plan as $subject)
                                    <div class='m-1'>
                                        <select class='subject-select form-group' name='' disabled>
                                            @foreach ($subjects as $item)
                                                <option value="{{ $item->id }}" class="form-control"
                                                    @if ($item->id == $subject) selected @endif>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <p>{{ $subject }}</p> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
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
            let subject_select = $('.subject-select');
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
            subject_select.select2({});
            teacher_select.select2({
                placeholder: "Chọn giáo viên",
            });
        });
    </script>
    <script>
        let classroom_select = $('#classroom_select');
        classroom_select.select2({})
        classroom_select.on('select2:select', function(e) {
            let training_id = classroom_select.find(':selected').data('training');
            let semester_wrap = $('.semester-wrap');
            $.ajax({
                type: "get",
                url: "{{ route('getSemester') }}/" + training_id,
                success: function(response) {
                    let semester = (response.semester.year) * 2;
                    semester_wrap.empty();
                    for (let i = 1; i <= semester; i++) {
                        semester_wrap.append(
                            `
                            <div class="card mb-0">
                                <div class="card-header" id="heading${i}">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title d-block py-1"
                                            data-toggle="collapse" href="#collapse${i}"
                                            aria-expanded="false" aria-controls="collapse${i}">
                                            Học kỳ ${i}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse${i}" class="collapse show"
                                    aria-labelledby="heading${i}"
                                    data-parent="#custom-accordion-one">
                                    <div class="card-body btn btn-danger p-1 m-1 btn-add-subject" id="btn-add-${i}" data-value="${i}">
                                    Thêm môn học 
                                        <i class="mdi mdi-plus-thick"></i>
                                    </div>
                                    <div class="add-subject p-1 m-1">
                                    </div>
                                </div>
                            </div>
                            `)

                    }
                    $.ajax({
                        type: "get",
                        url: "{{ route('loadSubjectFromClassRoom') }}/" +
                            classroom_select.val(),
                        dataType: "json",
                        success: function(response) {
                            var subjects = response;
                            let btn_add_subject = $('.btn-add-subject')
                            btn_add_subject.click(function(e) {
                                let subject_div = $(this).parent().children().last()
                                let semester_select = $(this).data('value');
                                let subject_select =
                                    "<div class='m-1 d-flex align-items-center'><select class='subject-select' name='subject_id[]'>";
                                subjects.forEach((element, index) => {
                                    subject_select +=
                                        `<option value="${semester_select}-${element.id}">${element.name}</option>`
                                });
                                subject_select += "</select>"
                                subject_select +=
                                    "<i class='mdi mdi-close p-1 btn btn-danger ml-2 btn-delete-subject'></i>"
                                subject_select += "</div>"
                                subject_div.append(subject_select);
                                $('.subject-select').select2({})
                            });
                        }
                    });
                }
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

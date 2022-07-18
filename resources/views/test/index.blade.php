{{-- @extends('layouts.master') --}}
{{-- @push('css') --}}
{{-- <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'>
<link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css'>
<link href="{{ asset('css/test.css') }}" rel="stylesheet" type="text/css"> --}}
{{-- @endpush --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css'>
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="row">
        <div class="col-2">
            @include('layouts.sidebar')
        </div>
        <div class="col-10">
            <div class="console-schedular">
                <div class="schedular-filters">
                    <div class="vehicle-type">
                        <select class="select full">
                            <option>Select Vehicle Type</option>
                            <option>SUV</option>
                            <option>SEDAN</option>
                        </select>
                    </div><!-- Vehicle Type -->
                    <div class="date-changer">
                        <a class="custom-btn prevDate" href="#" title=""><i
                                class="fa fa-chevron-left"></i></a>
                        <input type="text" class="new-datepicker" />
                        <a class="custom-btn nextDate" href="#" title=""><i
                                class="fa fa-chevron-right"></i></a>
                    </div><!-- Date Picker -->
                </div> <!-- Schedular Filters -->

                <div class="schedular-body">
                    <div class="main-schedular">
                        <div class="grids">
                            <div class="grids-head">
                                <div class="timeslot">Giờ học</div>
                                @for ($i = 2; $i < 8; $i++)
                                    <div class="timeslot">Thứ {{ $i }}</div>
                                @endfor
                                <div class="timeslot">Chủ nhật</div>
                            </div>
                            <div class="grids-body">
                                @for ($i = 1; $i < 16; $i++)
                                    <div class="grids-row">
                                        <div class="timeslot"> Tiết {{ $i }} </div>
                                        <div class="timeslot"></div>
                                        <div class="timeslot"></div>
                                        <div class="timeslot"></div>
                                        <div class="timeslot"></div>
                                        <div class="timeslot"></div>
                                        <div class="timeslot"></div>
                                        <div class="timeslot"></div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div><!-- Schedular Body -->
            </div><!-- console Schedular -->
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js'>
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js'></script>
    <script
        src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js'>
    </script>
    <script src="{{ asset('js/test.js') }}"></script>
</body>

</html>

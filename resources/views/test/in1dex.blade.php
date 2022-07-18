@extends('layouts.master')
@push('css')
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css'>
    <link href="{{ asset('css/test.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <div class="schedular-filters">
            <div class="vehicle-type">
                <select class="select full">
                    <option>Select Vehicle Type</option>
                    <option>SUV</option>
                    <option>SEDAN</option>
                </select>
            </div><!-- Vehicle Type -->

            <div class="date-changer">
                <a class="custom-btn prevDate" href="#" title=""><i class="fa fa-chevron-left"></i></a>
                <input type="text" class="new-datepicker" />
                <a class="custom-btn nextDate" href="#" title=""><i class="fa fa-chevron-right"></i></a>
            </div><!-- Date Picker -->
        </div>
        <div class="schedular-body">
            <div class="main-schedular">
                <div class="grids">
                    <div class="grids-head">
                        <div class="timeslot"> 12:00 AM </div>
                        <div class="timeslot"> 12:00 AM </div>
                        <div class="timeslot"> 12:00 AM </div>
                        <div class="timeslot"> 12:30 AM </div>
                        <div class="timeslot"> 01:00 AM </div>
                        <div class="timeslot"> 01:00 AM </div>
                        <div class="timeslot"> 01:00 AM </div>

                    </div>
                    <div class="grids-body">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="grids-row">
                                <div class="timeslot"> + </div>
                                <div class="timeslot"> + </div>
                                <div class="timeslot"> + </div>
                                <div class="timeslot"> + </div>
                                <div class="timeslot"> + </div>
                                <div class="timeslot"> + </div>
                                <div class="timeslot"> + </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ride-menu new-ride">
        <div class="menu-title">
            <h4>New Ride</h4>
            <p>Select Below An Action To Perform</p>
        </div>
        <ul>
            <li><a class="new-ride" data-toggle="modal" data-target="#add-new" href="#" title=""><i
                        class="ion-model-s"></i> Add A New Ride</a></li>
            <li><a data-rideclass="return" class="other-info-btn" href="#" title=""><i
                        class="ion-arrow-return-left"></i> <span>Return To Base</span></a></li>
            <li><a data-rideclass="maintenance" class="other-info-btn" href="#" title=""><i
                        class="ion-settings"></i> <span>Maintenance</span></a></li>
            <li><a data-rideclass="preparation" class="other-info-btn" href="#" title=""><i
                        class="ion-pinpoint"></i> <span>Preparation</span></a></li>
            <li><a data-rideclass="service" class="other-info-btn" href="#" title=""><i
                        class="ion-pull-request"></i> <span>Vehicle Service</span></a></li>
            <li class="bordered"><a href="#" title=""><i class="ion-android-cancel"></i> Cancel</a></li>
        </ul>
    </div>


    <div class="ride-menu ride-opts">
        <div class="ride-options">
            <ul>
                <li><a class="edit-ride" href="#" title=""><i class="ion-edit"></i> Edit Ride</a></li>
                <li><a class="delete-ride" href="#" title=""><i class="ion-android-remove-circle"></i>
                        Delete Ride</a></li>
            </ul>
        </div><!-- Ride Options -->
    </div>

    <!-- New Ride  -->
    <div class="modal custom-modal" id="add-new">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="custom-form" id="add-ride" name="Form">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4>New Ride</h4>
                            <span>Fill The Form Below To Add A New Ride</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-12  col-form-label">Passenger's Name</label>
                            <div class="col-lg-7 col-md-12">
                                <input id="pass-name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-12  col-form-label">Contact #:</label>
                            <div class="col-lg-7 col-md-12">
                                <input id="pass-contact" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-12  col-form-label">Pickup Location:</label>
                            <div class="col-lg-7 col-md-12">
                                <textarea id="pass-loc" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="custom-btn ride-cancel color2"><i class="ion-android-cancel"></i> Cancel
                            Ride</button>
                        <button class="custom-btn add-ride-btn" type="submit"><i class="ion-android-add-circle"></i>
                            Add A Ride</button>
                        <button class="custom-btn hidden edit-ride-btn" type="submit"><i
                                class="ion-android-add-circle"></i> Edit Ride</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal" id="assign-driver">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="custom-form" id="select-driver">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4>Assign A Driver</h4>
                            <span>Assign Driver To This Ride</span>
                        </div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table driver-selector custom-table style2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>License</th>
                                    <th>Weekly Earnings</th>
                                    <th>Working Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="console-driver-img"><img src="https://picsum.photos/100/100"
                                            style="width:30px"></td>
                                    <td class="console-driver" drivername="John Smith">John Smith</td>
                                    <td>4/5/20</td>
                                    <td>$345</td>
                                    <td>Mon-Tues-Wed-Thurs</td>
                                </tr>
                                <tr>
                                    <td class="console-driver-img"><img src="https://picsum.photos/100/100"
                                            style="width:30px"></td>
                                    <td class="console-driver" drivername="Bale Disel">Bale Disel</td>
                                    <td>5/15/19</td>
                                    <td>$564</td>
                                    <td>Fri-Sat-Sun</td>
                                </tr>
                                <tr>
                                    <td class="console-driver-img"><img src="https://picsum.photos/100/100"
                                            style="width:30px"></td>
                                    <td class="console-driver" drivername="Macelo Benz">Macelo Benz</td>
                                    <td>12/30/20</td>
                                    <td>$543</td>
                                    <td>Mon-Tues-Wed-Thurs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="#" title="" class="custom-btn cancel-popup color2" data-dismiss="modal"><i
                                class="ion-android-cancel"></i> Cancel</a>
                        <button class="custom-btn" type="submit"><i class="ion-android-add-circle"></i>
                            Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal custom-modal" id="change-ride">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="custom-form" id="ride-changer">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4>Edit Ride</h4>
                            <span>Edit The Following Ride</span>
                        </div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-12  col-form-label">Edit This Ride</label>
                            <div class="col-lg-7 col-md-12">
                                <select class="select change-ride">
                                    <option value="return">Return</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="preparation">Preparation</option>
                                    <option value="service">Service</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" title="" class="custom-btn color2" data-dismiss="modal"><i
                                class="ion-android-cancel"></i> Cancel</a>
                        <button class="custom-btn" type="submit"><i class="ion-android-add-circle"></i>
                            Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
@endpush

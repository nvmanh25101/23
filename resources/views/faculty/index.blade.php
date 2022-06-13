@extends('layout.master')
@section('content')
    <div class="table-responsive">
        <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="products-datatable_length"><label>Display <select
                                class="custom-select custom-select-sm ml-1 mr-1">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="-1">All</option>
                            </select> customers</label></div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="products-datatable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                class="form-control form-control-sm" placeholder=""
                                aria-controls="products-datatable"></label></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table
                        class="table table-centered table-striped dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                        id="products-datatable" role="grid" aria-describedby="products-datatable_info"
                        style="width: 1527px;">
                        <thead>
                            <tr role="row">
                                <th style="width: 28.6px;"
                                    class="dt-checkboxes-cell dt-checkboxes-select-all sorting_disabled" rowspan="1"
                                    colspan="1" data-col="0" aria-label="
                            
                                
                                &amp;nbsp;
                            
                        ">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="products-datatable" rowspan="1"
                                    colspan="1" style="width: 247.8px;"
                                    aria-label="Customer: activate to sort column ascending">Customer</th>
                                <th class="sorting" tabindex="0" aria-controls="products-datatable" rowspan="1"
                                    colspan="1" style="width: 180.8px;"
                                    aria-label="Phone: activate to sort column ascending">Phone</th>
                                <th class="sorting" tabindex="0" aria-controls="products-datatable" rowspan="1"
                                    colspan="1" style="width: 258.8px;"
                                    aria-label="Email: activate to sort column ascending">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="products-datatable" rowspan="1"
                                    colspan="1" style="width: 163.8px;"
                                    aria-label="Location: activate to sort column ascending">Location</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="products-datatable" rowspan="1"
                                    colspan="1" style="width: 147.8px;" aria-sort="ascending"
                                    aria-label="Create Date: activate to sort column descending">Create Date</th>
                                <th class="sorting" tabindex="0" aria-controls="products-datatable" rowspan="1"
                                    colspan="1" style="width: 91.8px;"
                                    aria-label="Status: activate to sort column ascending">Status</th>
                                <th style="width: 75.6px;" class="sorting_disabled" rowspan="1" colspan="1"
                                    aria-label="Action">Action</th>
                            </tr>
                        </thead>
                        <tbody>













                            <tr role="row" class="odd">
                                <td class="dt-checkboxes-cell" tabindex="0">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-2.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Rory Seekamp</a>
                                </td>
                                <td>
                                    078 5054 8877
                                </td>
                                <td>
                                    roryamp@dayrep.com
                                </td>
                                <td>
                                    United States
                                </td>
                                <td class="sorting_1">
                                    03/24/2018
                                </td>
                                <td>
                                    <span class="badge badge-danger-lighten">Blocked</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-10.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Dean Smithies</a>
                                </td>
                                <td>
                                    077 6157 4248
                                </td>
                                <td>
                                    deanes@dayrep.com
                                </td>
                                <td>
                                    Singapore
                                </td>
                                <td class="sorting_1">
                                    04/09/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="odd">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-9.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Anna Ciantar</a>
                                </td>
                                <td>
                                    (216) 76 298 896
                                </td>
                                <td>
                                    annac@hotmai.us
                                </td>
                                <td>
                                    Philippines
                                </td>
                                <td class="sorting_1">
                                    05/06/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td class="dt-checkboxes-cell" tabindex="0">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-1.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Labeeb Ghali</a>
                                </td>
                                <td>
                                    050 414 8778
                                </td>
                                <td>
                                    labebswad@teleworm.us
                                </td>
                                <td>
                                    United Kingdom
                                </td>
                                <td class="sorting_1">
                                    06/19/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="odd">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-3.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Kathryn S.
                                        Collier</a>
                                </td>
                                <td>
                                    828-216-2190
                                </td>
                                <td>
                                    collier@jourrapide.com
                                </td>
                                <td>
                                    Canada
                                </td>
                                <td class="sorting_1">
                                    06/30/2018
                                </td>
                                <td>
                                    <span class="badge badge-danger-lighten">Blocked</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-4.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Paul J. Friend</a>
                                </td>
                                <td>
                                    937-330-1634
                                </td>
                                <td>
                                    pauljfrnd@jourrapide.com
                                </td>
                                <td>
                                    New York
                                </td>
                                <td class="sorting_1">
                                    07/07/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="odd">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-5.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Zara Raws</a>
                                </td>
                                <td>
                                    (02) 75 150 655
                                </td>
                                <td>
                                    austin@dayrep.com
                                </td>
                                <td>
                                    Germany
                                </td>
                                <td class="sorting_1">
                                    07/15/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-7.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Jenny C. Gero</a>
                                </td>
                                <td>
                                    078 7173 9261
                                </td>
                                <td>
                                    jennygero@teleworm.us
                                </td>
                                <td>
                                    Lesotho
                                </td>
                                <td class="sorting_1">
                                    08/02/2018
                                </td>
                                <td>
                                    <span class="badge badge-danger-lighten">Blocked</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="odd">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-8.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Edward Roseby</a>
                                </td>
                                <td>
                                    078 6013 3854
                                </td>
                                <td>
                                    edwardR@armyspy.com
                                </td>
                                <td>
                                    Monaco
                                </td>
                                <td class="sorting_1">
                                    08/23/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0" class="dt-checkboxes-cell">
                                    <div class="custom-control custom-checkbox"><input type="checkbox"
                                            class="custom-control-input dt-checkboxes"><label
                                            class="custom-control-label">&nbsp;</label></div>
                                </td>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-6.jpg" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Annette P.
                                        Kelsch</a>
                                </td>
                                <td>
                                    (+15) 73 483 758
                                </td>
                                <td>
                                    annette@email.net
                                </td>
                                <td>
                                    India
                                </td>
                                <td class="sorting_1">
                                    09/05/2018
                                </td>
                                <td>
                                    <span class="badge badge-success-lighten">Active</span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i
                                            class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="products-datatable_info" role="status" aria-live="polite">Showing
                        customers 1 to 10 of 12</div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="products-datatable_paginate">
                        <ul class="pagination pagination-rounded">
                            <li class="paginate_button page-item previous disabled" id="products-datatable_previous"><a
                                    href="#" aria-controls="products-datatable" data-dt-idx="0" tabindex="0"
                                    class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                            <li class="paginate_button page-item active"><a href="#" aria-controls="products-datatable"
                                    data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="products-datatable"
                                    data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item next" id="products-datatable_next"><a href="#"
                                    aria-controls="products-datatable" data-dt-idx="3" tabindex="0"
                                    class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

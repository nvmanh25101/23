@extends('layout.master')
@section('content')
    <div class="">
        <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add
                        Customers</a>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                        <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                        <button type="button" class="btn btn-light mb-2">Export</button>
                    </div>
                </div><!-- end col-->
            </div>
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
                        id="products-datatable" role="grid" aria-describedby="products-datatable_info">
                        <thead>
                            <tr role="row">
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
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

@extends('layout.main')
@section('title','Admin Dashboard')
@section('main-container')
!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Analytics</h4>
                                          
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                           <div class="col-xl-8">
                               <div class="card">
                                   <div class="card-body">
                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle arrow-none p-0 text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="uil uil-ellipsis-v fs-13"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-refresh me-2"></i>Refresh Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-export me-2"></i>Export Report</a>
                                        </div>
                                    </div>
                                    <h4 class="card-title header-title">Overviews</h4>
                                    <div class="row">
                                        <div class="col">
                                            <ul class="nav nav-tabs d-block d-sm-flex">
                                                <li class="nav-item">
                                                    <a href="#subscribers" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        <h6 class="text-muted fs-14">Subscribers</h6>
                                                        <h3>786</h3>
                                                    </a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a href="#total-views" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                        <h6 class="text-muted fs-14">Total views</h6>
                                                        <h3>1.356</h3>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#bounce-rate" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        <h6 class="text-muted fs-14">Bounce rate</h6>
                                                        <h3>87%</h3>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="tab-content">
                                                <div class="tab-pane" id="subscribers">
                                                    <div dir="ltr">
                                                        <div id="overviews1" class="apex-charts" data-colors="#5369f8"></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane active" id="total-views">
                                                    <div dir="ltr">
                                                        <div id="overviews2" class="apex-charts" data-colors="#5369f8,#fa5c7c"></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="bounce-rate">
                                                    <div dir="ltr">
                                                        <div id="overviews3" class="apex-charts" data-colors="#56bbd7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   </div> <!--end card body-->
                               </div> <!--end card-->
                           </div> <!--end col-->
                           <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none p-0 text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="uil uil-ellipsis-v fs-13"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-refresh me-2"></i>Refresh Report</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-export me-2"></i>Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="card-title header-title">New Users</h4>
                                        <div class="row border-bottom justify-content-between align-items-end pt-2 pb-3">
                                            <div class="col-6 col-md-5">
                                                <h6 class="text-muted mt-0 fs-14">New users this week</h6> 
                                                <h3 class="my-2">18 324</h3>
                                                <h6 class="text-success mb-0">+17.98%</h6>
                                            </div>
                                            <div class="col-5 col-md-3">
                                                <div id="chart1" data-colors="#43d39e"></div>
                                            </div>
                                        </div>
                                        <div class="row border-bottom justify-content-between align-items-end py-3">
                                            <div class="col-6 col-md-5">
                                                <h6 class="text-muted mt-0 fs-14">New users this month</h6> 
                                                <h3 class="my-2">182 578</h3>
                                                <h6 class="text-success mb-0">+24.98%</h6>
                                            </div>
                                            <div class="col-5 col-md-3">
                                                <div id="chart2" data-colors="#ff5c75"></div>
                                            </div>
                                        </div>
                                        <div class="row border-bottom justify-content-between align-items-end py-3">
                                            <div class="col-6 col-md-5">
                                                <h6 class="text-muted mt-0 fs-14">New users this year</h6> 
                                                <h3 class="my-2">24 182 579</h3>
                                                <h6 class="text-success mb-0">+39.52%</h6>
                                            </div>
                                            <div class="col-5 col-md-3">
                                                <div id="chart3" data-colors="#43d39e"></div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between align-items-end pb-2 pt-3">
                                            <div class="col-6 col-md-5">
                                                <h6 class="text-muted mt-0 fs-14">Returning users</h6> 
                                                <h4 class="my-2">82 578</h4>
                                                <h6 class="text-danger mb-0">-26.47%</h6>
                                            </div>
                                            <div class="col-5 col-md-3">
                                                <div class="" id="chart4" data-colors="#ff5c75"></div>
                                            </div>
                                        </div>                                                
                                    </div> <!--end card body-->
                                </div> <!--end card-->
                            </div> <!--end col-->
                        </div> <!--end row-->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none p-0 text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="uil uil-ellipsis-v fs-13"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-refresh me-2"></i>Refresh Report</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-export me-2"></i>Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="card-title header-title">Social Media Traffic</h4>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div dir="ltr">
                                                    <div id="session-os" class="apex-charts" data-colors="#5369f8,#43d39e,#f3f4f7"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 offset-1 my-3">
                                                <div class="border-bottom">
                                                    <div class="my-2 py-2">
                                                        <h6 class="fs-14 text-muted">Twitter</h6>
                                                        <h3>2250k</h3>
                                                    </div>
                                                </div>
                                                <div class="border-bottom">
                                                    <div class="my-2 py-2">
                                                        <h6 class="fs-14 text-muted">Instagram</h6>
                                                        <h3>1501k</h3>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="my-2 py-2">
                                                        <h6 class="fs-14 text-muted">Facebook</h6>
                                                        <h3>750k</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--end card body-->
                                </div> <!--end card-->
                            </div> <!--end col-->                                                      
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="" class="p-0 float-end">Export <i class="uil uil-export ms-1"></i></a>
                                                <h4 class="card-title header-title">Sources</h4>
                                                <div class="table-responsive table-nowrap mt-3">
                                                    <table class="table table-sm table-centered mb-0 fs-13">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Types</th>
                                                                <th style="width: 30%;">Sessions</th>
                                                                <th style="width: 30%;">Views</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Direct</td>
                                                                <td>358</td>
                                                                <td>250</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Referal</td>
                                                                <td>501</td>
                                                                <td>50</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td>460</td>
                                                                <td>600</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> <!--end card body-->
                                        </div> <!--end card-->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="" class="p-0 float-end">Export <i class="uil uil-export ms-1"></i></a>
                                                <h4 class="card-title header-title">Engagement Overviews</h4>
                                                <div class="table-responsive table-nowrap mt-3">
                                                    <table class="table table-sm table-centered mb-0 fs-13">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Duration (Secs)</th>
                                                                <th style="width: 30%;">Sessions</th>
                                                                <th style="width: 30%;">Views</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>0-30</td>
                                                                <td>2,250</td>
                                                                <td>4,250</td>
                                                            </tr>
                                                            <tr>
                                                                <td>31-60</td>
                                                                <td>1,501</td>
                                                                <td>2,050</td>
                                                            </tr>
                                                            <tr>
                                                                <td>61-120</td>
                                                                <td>750</td>
                                                                <td>1,600</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> <!--end card body-->
                                        </div> <!--end card-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="" class="p-0 float-end">Export <i class="uil uil-export ms-1"></i></a>
                                                <h4 class="card-title header-title">Platforms</h4>
                                                <div class="table-responsive table-nowrap mt-3">
                                                    <table class="table table-sm table-centered mb-0 fs-13">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>System</th>
                                                                <th>Visits</th>
                                                                <th style="width: 40%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Linux</td>
                                                                <td>2,250</td>
                                                                <td>
                                                                    <div class="progress" style="height: 3px;">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="width: 65%; height: 20px;" aria-valuenow="65"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Android</td>
                                                                <td>1,501</td>
                                                                <td>
                                                                    <div class="progress" style="height: 3px;">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="width: 45%; height: 20px;" aria-valuenow="45"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Windows</td>
                                                                <td>750</td>
                                                                <td>
                                                                    <div class="progress" style="height: 3px;">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="width: 30%; height: 20px;" aria-valuenow="30"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> <!--end card body-->                                  
                                        </div> <!--end card-->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="" class="p-0 float-end">Export <i class="uil uil-export ms-1"></i></a>
                                                <h4 class="card-title header-title">Channels</h4>
                                                <div class="table-responsive table-nowrap mt-3">
                                                    <table class="table table-sm table-centered mb-0 fs-13">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Channel</th>
                                                                <th>Visits</th>
                                                                <th style="width: 40%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Direct</td>
                                                                <td>2,050</td>
                                                                <td>
                                                                    <div class="progress" style="height: 3px;">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="width: 65%; height: 20px;" aria-valuenow="65"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organic Search</td>
                                                                <td>1,405</td>
                                                                <td>
                                                                    <div class="progress" style="height: 3px;">
                                                                        <div class="progress-bar bg-info" role="progressbar"
                                                                            style="width: 45%; height: 20px;" aria-valuenow="45"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Social</td>
                                                                <td>540</td>
                                                                <td>
                                                                    <div class="progress" style="height: 3px;">
                                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                                            style="width: 25%; height: 20px;" aria-valuenow="25"
                                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> <!--end card body-->
                                        </div> <!--end card-->
                                    </div>
                                </div>
                            </div> <!--end col-->                            
                        </div> <!--end row-->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="" class="p-0 float-end">Export <i class="uil uil-export ms-1"></i></a>
                                        <h4 class="card-title header-title">Views Per Minute</h4>
                                        <div class="table-responsive table-nowrap mt-2">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Page</th>
                                                        <th>Bounce Rate</th>
                                                        <th>Traffic Type</th>
                                                        <!-- <th>Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/dashboard/ecommerce</a></td>
                                                        <td>87.5%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/dashboard/analytics</a></td>
                                                        <td>21.48%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/apps/calender</a></td>
                                                        <td>63.59%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/apps/email</a></td>
                                                        <td>7.12%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/custom/pages</a></td>
                                                        <td>86.46%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/components/ucharts</a></td>
                                                        <td>98.48%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/components/charts</a></td>
                                                        <td>23.79%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);" class="text-muted">/shreyu/components/tables</a></td>
                                                        <td>21.27%</td>
                                                        <td>
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><i class="uil uil-desktop"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-mobile-android-alt"></i></li>
                                                                <li class="list-inline-item"><i class="uil uil-tablet"></i></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!--end card body-->
                                </div> <!--end card-->
                            </div> <!--end col-->
                            <div class="col-lg-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none p-0 text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="uil uil-ellipsis-v fs-13"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-refresh me-2"></i>Refresh Report</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-export me-2"></i>Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="card-title header-title">Session by Locations</h4>
                                        <div class="my-3">
                                            <div id="world-map-markers" style="height: 407px"></div>
                                        </div>
                                    </div> <!--end card body-->
                                </div> <!--end card-->
                            </div> <!--end col-->                          
                            <div class="col-lg-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none p-0 text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="uil uil-ellipsis-v fs-13"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-refresh me-2"></i>Refresh Report</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="uil uil-export me-2"></i>Export Report</a>
                                            </div>
                                        </div>
                                        <h4 class="card-title header-title">Session by Browser</h4>
                                        <div class="my-3" dir="ltr">
                                            <div id="session-browser" class="apex-charts" data-colors="#5369f8,#43d39e,#ff5c75,#ffbe0b"></div>
                                        </div>
                                        <div>
                                            <p class="mb-1">
                                                <i class="uil uil-square text-primary me-1"></i> Safari
                                                <span class="float-end">32.8%</span>
                                            </p>
                                            <p class="mb-1">
                                                <i class="uil uil-square text-success me-1"></i> Firefox
                                                <span class="float-end">16.5%</span>
                                            </p>
                                            <p class="mb-1">
                                                <i class="uil uil-square text-danger me-1"></i> Chrome
                                                <span class="float-end">38.3%</span>
                                            </p>
                                            <p class="mb-0">
                                                <i class="uil uil-square text-warning me-1"></i> Internet Explorer
                                                <span class="float-end">12.4%</span>
                                            </p>
                                        </div>
                                    </div> <!--end card body-->
                                </div> <!--end card-->
                            </div> <!--end col-->
                        </div> <!--end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
@endsection

@section('dash-footer')
 
 
<script src="<?php echo URL("/") ?>/assets/libs/apexcharts/apexcharts.min.js"></script> 

<script src="<?php echo URL("/") ?>/assets/libs/flatpickr/flatpickr.min.js"></script>
<!-- page js -->
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-in-mill-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-au-mill-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-il-chicago-mill-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-uk-mill-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-ca-lcc-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-europe-mill-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-fr-merc-en.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-es-merc.js"></script>
<script src="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-es-mill.js"></script>

<script src="<?php echo URL("/") ?>/assets/js/pages/dashboard-analytics.init.js"></script>

@endsection
@extends('layout.main')
@section('title','Course')
@section('main-container')


<!-- ============================================================== -->
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
                        <h4 class="page-title">All Contents</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="20">Sr. No.</th>
                                        <th>Content Name</th>
                                        <th>Class</th>
                                        <th>Template Type</th>
                                        <th width="80">Action</th>
                                    </tr>
                                </thead>



                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>


        </div> <!-- container -->

    </div> <!-- content -->

    @endsection
    @section('auth-footer')
    <script>
    $(function() {
        var table = $('#tables').DataTable({
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    previous: "<i class='uil uil-angle-left'>",
                    next: "<i class='uil uil-angle-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            "destroy": true,
            ajax: "{{ url('admin/content-list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                },
                {
                    data: 'class',
                },
                {
                    data: 'template_type',
                },
                {
                    data: 'action',
                },

            ]
        });


    });
   
$('#date').on('change', function() {
    document.getElementById("apply_to_all").checked = false;
});
    </script>
    @endsection
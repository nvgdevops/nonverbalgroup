@extends('layout.main')
@section('title','Quiz Submission')
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
                        <h4 class="page-title">Quiz Submission</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
           <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="20">Sr. No.</th>
                                        <th>User Name</th>
                                        <th>Lesson Name</th>
                                        <th>Quiz Name</th>
                                        <th>Status</th>
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
            language:{paginate:{previous:"<i class='uil uil-angle-left'>",next:"<i class='uil uil-angle-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")},
            "destroy": true,
            ajax: "{{ url('admin/quiz-submission/data') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                { data: 'user_name' },
                { data: 'lesson_name' },
                { data: 'quiz_name' },
                { data: 'is_complete' },
                { data: 'action' }
            ]
        });
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
@endsection

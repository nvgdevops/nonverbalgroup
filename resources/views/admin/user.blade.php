@extends('layout.main')
@section('title','Admin Dashboard')
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
                <div class="col-9">
                    <div class="page-title-box">
                        <h4 class="page-title">Users Management</h4>
                    </div>
                </div>
                <div class="col-3">
                    <div class="page-title-box" style="display:block;text-align:right;">
                        <a href="{{route('admin.add_user')}}" class="btn btn-primary btn-dark">Add New User</a>
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
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Membership</th>
                                        <th>Action</th>
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
        ajax: "{{route('admin.user')}}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            { data: 'name' },
            { data: 'email' },
            { data: 'membership' },
            { data: 'action' }
        ]
    });

    // $("#tables").dataTable().fnDestroy();
});


function submitMembership(user_id) {
    $('#membershipFrom'+user_id).submit();
}

</script>

@endsection
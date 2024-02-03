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
                        <h4 class="page-title">@if(isset($course_edit->id)) Edit Courses @else Courses @endif</h4>
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
                            <h4 class="mb-3 header-title mt-0">Add New Course</h4>
                            <form action="{{ isset($course_edit->id) ? '/admin/edit_course/' . $course_edit->id : '' }}"
                                method="post">
                                @csrf
                                @if(isset($course_edit->id))
                                @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label" for="">Enter Course Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Course name"
                                            name="name"
                                            value="{{ old('name', isset($course_edit->id) ? $course_edit->name : '') }}" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    

                                    <!-- <div class="col-2">
                                        <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">@if(isset($course_edit->id))
                                            Edit @else Add @endif</button>
                                    </div> -->
                                </div>
                                
                                <div class="row my-3">
                                    <div class="col-6">
                                    <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">@if(isset($course_edit->id))
                                            Edit @else Add @endif</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mb-3 header-title mt-0">All Courses</h4>
                                </div>
                                <div class="col-6" style="text-align:right;">
                                    <a href="{{route('admin.export_course')}}" class="btn btn-primary btn-dark mb-3">Export CSV</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-dark mb-3">Import CSV</button>
                                </div>
                            </div>  
                            <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="20">Sr. No.</th>
                                        <th>Course Name</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.import_course') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-12 form-group mb-3">
                    <label class="form-label">Upload Course CSV File</label>
                    <input type="file" required accept=".csv" class="form-control" name="import_file" />
                </div>
                <div class="col-12 mb-3" style="text-align:right;">
                    <button type="submit" class="btn btn-primary btn-dark">Import</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

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
            ajax: "{{ url('admin/course/{id}') }}",
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
                    data: 'action',
                },

            ]
        });


    });
    $(document).ready(function(){
    $("#apply_to_all").click(function() {
        if ($("#apply_to_all").is(':checked')) {
            var date = $("input[name='release_date[]']").val();
            $("input[name='release_date[]']").val(date);
        }
    });
});
$('#date').on('change', function() {
    document.getElementById("apply_to_all").checked = false;
});
    </script>
    @endsection
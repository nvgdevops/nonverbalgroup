@extends('layout.main')
@section('title','Phase')
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
                        <h4 class="page-title">@if(isset($phase_edit->id)) Edit Phases @else Phases @endif</h4>
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
                            
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            
                            <h4 class="mb-3 header-title mt-0">Add New Phase</h4>
                            <form action="{{ isset($phase_edit->id) ? '/admin/edit_phase/' . $phase_edit->id : '' }}"
                                method="post">
                                @csrf
                                @if(isset($phase_edit->id))
                                @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Enter Phase Name</label>
                                            <input type="text" class="form-control" id="" placeholder="Enter Phase name"
                                                name="name"
                                                value="{{ old('name', isset($phase_edit->id) ? $phase_edit->name : '') }}" />
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="col-4"> 
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Phase Length</label>
                                            <input type="text" class="form-control" id="" placeholder="Enter Phase Length"
                                                name="phase_length"
                                                value="{{ old('phase_length', isset($phase_edit->id) ? $phase_edit->phase_length : '') }}" />
                                            @if ($errors->has('phase_length'))
                                            <span class="text-danger">{{ $errors->first('phase_length') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Enter Phase Title</label>
                                            <input type="text" class="form-control" id="" placeholder="Enter Phase Title"
                                                name="phase_title"
                                                value="{{ old('phase_title', isset($phase_edit->id) ? $phase_edit->phase_title : '') }}" />
                                            @if ($errors->has('phase_title'))
                                            <span class="text-danger">{{ $errors->first('phase_title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="">Phase Description</label>
                                        <textarea  class="form-control" id=""  
                                            name="phase_dec"
                                            value="" >{{ old('phase_dec', isset($phase_edit->id) ? $phase_edit->phase_dec : '') }}</textarea>                                        @if ($errors->has('phase_title'))
                                        <span class="text-danger">{{ $errors->first('phase_dec') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="">Select Course</label>
                                        <select class="form-select" id="" name="course_id">
                                            <option value="">Select Course</option>
                                            @foreach($course as $c)
                                            <option value="{{ $c->id }}" @if( old('course_id')==$c->id ||
                                                isset($phase_edit->course_id) && $phase_edit->course_id == $c->id ) selected
                                                @endif>{{ $c->name }}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('course_id'))
                                        <span class="text-danger">{{ $errors->first('course_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="">Enter Phase Order</label>
                                        <input type="text" class="form-control validatePrice" id="" placeholder="Enter Phase Order"
                                            name="order"
                                            value="{{ old('order', isset($phase_edit->id) ? $phase_edit->order : '') }}" />
                                        @if ($errors->has('order'))
                                        <span class="text-danger">{{ $errors->first('order') }}</span>
                                        @endif
                                    </div> 
                                </div>

                                    <!-- <div class="col-2">
                                        <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">@if(isset($phase_edit->id))
                                            Edit @else Add @endif</button>
                                    </div> -->
                                <div class="row my-3">
                                    <div class="col-6">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Release Option</th>
                                                    <th scope="col">Release Date</th>

                                                </tr>
                                            </thead>
                                            <?php $id = 1 ?>
                                            @foreach($membership as $key=>$m_ship)
                                            <tbody>
                                                <tr>
                                                    <th scope="row">{{$id++}}</th>
                                                    <td>{{$m_ship->	membership_type}} <input type="hidden"
                                                            name="membership_id[]" value="{{$m_ship->id}}"> </td>
                                                            <td> <input type="datetime-local" class="form-control datetimepicker" id="date"
                                                            name="release_date[]" value="{{$m_ship->release_date}}"> 
                                                            @if($key == 0)
                                                            <div class="pt-2">
                                                            <input type="checkbox" id="apply_to_all">
                                                            <label for="apply_to_all">Same for all</label></div>
                                                             @endif

                                                        </td>

                                                </tr>

                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                    <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">@if(isset($phase_edit->id))
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
                                    <h4 class="mb-3 header-title mt-0">All Phases</h4>
                                </div>
                                <div class="col-6" style="text-align:right;">
                                    <a href="{{route('admin.export_phase')}}" class="btn btn-primary btn-dark mb-3">Export CSV</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-dark mb-3">Import CSV</button>
                                </div>
                            </div>  
                            
                            <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="20">Sr. No.</th>
                                        <th>Phase Name</th>
                                        <th>Course Name</th>
                                        <th>Order</th>
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
        <form method="post" action="{{ route('admin.import_phase') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-12 form-group mb-3">
                    <label class="form-label">Upload Phase CSV File</label>
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
            ajax: "{{ url('admin/phase/{id}') }}",
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
                    data: 'course_name',

                },
                {
                    data: 'order',

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
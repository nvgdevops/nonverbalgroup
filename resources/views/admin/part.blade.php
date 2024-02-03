@extends('layout.main')
@section('title','Part')
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
                        <h4 class="page-title">Parts</h4>
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
                            <h4 class="mb-3 header-title mt-0">@if(isset($part_edit->id)) Edit Part @else Add Part
                                @endif</h4>
                            <form action="{{ isset($part_edit->id) ? '/admin/edit_part/' . $part_edit->id : '' }}"
                                method="post">
                                @csrf
                                @if(isset($part_edit->id))
                                @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Enter Part Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter part name"
                                            name="name"
                                            value="{{ old('name', isset($part_edit->id) ? $part_edit->name : '') }}">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Part Length</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter part Length"
                                            name="part_length"
                                            value="{{ old('name', isset($part_edit->id) ? $part_edit->part_length : '') }}">
                                        @if ($errors->has('part_length'))
                                        <span class="text-danger">{{ $errors->first('part_length') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Select Phase</label>
                                        <select class="form-select" name="phase_id">
                                            <option>Select Phase</option>
                                            @foreach($part as $p)
                                            <option value="{{ $p->id }}" @if( old('phase_id')==$p->id ||
                                                isset($part_edit->phase_id) && $part_edit->phase_id == $p->id ) selected
                                                @endif>{{ $p->name }}</option>
                                            @endforeach


                                        </select>
                                        @if ($errors->has('phase_id'))
                                        <span class="text-danger">{{ $errors->first('phase_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="">Enter Part Order</label>
                                        <input type="text" class="form-control validatePrice" id="" placeholder="Enter part order"
                                            name="order"
                                            value="{{ old('order', isset($part_edit->id) ? $part_edit->order : '') }}">
                                        @if ($errors->has('order'))
                                        <span class="text-danger">{{ $errors->first('order') }}</span>
                                        @endif
                                    </div>
                                    <!-- <div class="col-2">
                                        <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">Submit</button>
                                    </div> -->
                                </div>
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
                                            class="btn btn-primary btn-dark form-control">Submit</button>
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
                                    <h4 class="mb-3 header-title mt-0">All Parts</h4>
                                </div>
                                <div class="col-6" style="text-align:right;">
                                    <a href="{{route('admin.export_part')}}" class="btn btn-primary btn-dark mb-3">Export CSV</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-dark mb-3">Import CSV</button>
                                </div>
                            </div>  
                            <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="20">Sr. No.</th>
                                        <th>Part Name</th>
                                        <th>Phase Name</td>
                                        <th>Order</td>
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
        <form method="post" action="{{ route('admin.import_part') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-12 form-group mb-3">
                    <label class="form-label">Upload Part CSV File</label>
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
            "destroy": true,
            language: {
                paginate: {
                    previous: "<i class='uil uil-angle-left'>",
                    next: "<i class='uil uil-angle-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            ajax: "{{route('admin.part')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'pname',
                    name: 'pname'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'order',
                    name: 'order'
                },
                {
                    data: 'action',

                },

            ]
        });

        // $("#tables").dataTable().fnDestroy();
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
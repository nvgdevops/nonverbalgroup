@extends('layout.main')
@section('title','Lesson')
@section('main-container')
<?php 
use App\Models\Lesson;
?>
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
                                    <h4 class="page-title">Lessons</h4>
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
										<h4 class="mb-3 header-title mt-0">@if(isset($lesson_edit->id)) Edit Lessons @else Add
                                        Lessons @endif</h4>
                                        <form  action="{{ isset($lesson_edit->id) ? '/admin/edit_lesson/' . $lesson_edit->id : '' }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($lesson_edit->id))
                                        @method('PATCH')
                                        @endif
											<div class="row">
												<div class="col-3 mb-2">
													<label class="form-label" for="">Enter Lesson Name</label>
													<input type="text" class="form-control" id="" placeholder="Enter Lessons name" name="lesson_name"
                                                        value="{{ old('lesson_name', isset($lesson_edit->id) ? $lesson_edit->lesson_name : '') }}" required>
                                                        @if ($errors->has('lesson_name'))
                                                    <span class="text-danger">{{ $errors->first('lesson_name') }}</span>
                                                    @endif
												</div>
												<div class="col-3 mb-2">
													<label class="form-label" for="">Parent Lesson</label>
													 <select class="form-select"  name="sub_lesson">
														<option value="0">Select Sub Lesson</option>
                                                        <?php
                                                          $lesson = Lesson::where("sub_lesson",'=', 0)->get();
                                                        ?>
                                                    @foreach($lesson as $l )
                                                    <option value="{{ $l->id }}" @if( old('sub_lesson') == $l->id ||  isset($lesson_edit->sub_lesson)
                                                        &&
                                                        $lesson_edit->sub_lesson == $l->id ) selected @endif>{{ $l->lesson_name }}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('lesson_type'))
                                            <span class="text-danger">{{ $errors->first('lesson_type') }}</span>
                                            @endif

												</div>
												<div class="col-3 mb-2">
													<label class="form-label" for="">Select Part</label>
													 <select class="form-select" name="part_id">
														<option value="0">Select Part</option>
                                                        @foreach($part as $parts)
														<option value="{{ $parts->id  }}" @if( old('part_id') == $parts->id ||  isset($lesson_edit->part_id) &&
                                                    $lesson_edit->part_id == $parts->id ) selected @endif>{{ $parts->name}}</option>
                                                        @endforeach
													
													</select>
                                                    @if ($errors->has('part_id'))
                                            <span class="text-danger">{{ $errors->first('part_id') }}</span>
                                            @endif
												</div>
										<?php /* <div class="col-3 mb-2">
													<label class="form-label" for="">Membership</label>
													<select class="form-select" name="membership_id" required>
														<option>Select Membership</option>
                                                        @foreach($membership as $memberships)
														<option value="{{ $memberships->id  }} " @if(  old('membership_id') == $memberships->id ||   isset($lesson_edit->
                                                    membership_id) && $lesson_edit->membership_id == $memberships->id )
                                                    selected @endif> {{ $memberships->membership_type}}</option>
                                                        @endforeach
														
													</select>
                                                    @if ($errors->has('membership_id'))
                                            <span class="text-danger">{{ $errors->first('membership_id') }}</span>
                                            @endif
												</div> */ ?>
                                                <div class="col-3 mb-2">
													<label class="form-label" for="">Select Phase</label>
													 <select class="form-select" name="phase_id">
														<option value="0">Select Phase</option>
                                                        @foreach($phase as $phases )
														<option  value="{{ $phases->id }}" @if( old('phase_id') == $phases->id ||  isset($lesson_edit->phase_id)
                                                        &&
                                                        $lesson_edit->phase_id == $phases->id ) selected @endif >{{ $phases->name }}</option>
                                                        @endforeach
														
													</select>
                                                    @if ($errors->has('phase_id'))
                                                <span class="text-danger">{{ $errors->first('phase_id') }}</span>
                                                @endif
												</div>
												<div class="col-3 mb-2">
													<label class="form-label" for="">Lessons Type</label>
													 <select class="form-select" name="lesson_type" >
														<option value="0">Select Lesson Type</option>
														<option value="training" @if( old('lesson_type') == 'training'  || isset($lesson_edit->
                                                        lesson_type) && $lesson_edit->lesson_type == 'training')
                                                        selected
                                                        @endif >Training </option>
                                                    <option value="assessment"@if( old('lesson_type') == 'assessment'  ||  isset($lesson_edit->
                                                        lesson_type) && $lesson_edit->lesson_type == 'assessment')
                                                        selected
                                                        @endif >Assessment</option>
													</select>
                                                    @if ($errors->has('lesson_type'))
                                            <span class="text-danger">{{ $errors->first('lesson_type') }}</span>
                                            @endif
												</div>
												 <div class="col-3 mb-2 inputbox" id="" style="<?php if(isset($lesson_edit->lesson_type) && $lesson_edit->lesson_type == 'training'){ echo "display:block"; } ?>">
													<label class="form-label" for="">Add wistia video ID</label>
													<input type="text" class="form-control" id=""  name="wistia_video_id" value="{{ old('wistia_video_id', isset($lesson_edit->id) ? $lesson_edit->wistia_video_id : '') }}">
                                                    @if ($errors->has('wistia_video_id'))
                                                    <span class="text-danger">{{ $errors->first('wistia_video_id') }}</span>
                                                    @endif
												</div>
												 <div class="col-3 mb-2">
													<label class="form-label" for="">Video/Assessment Length</label>
													<input type="text" class="form-control" id=""  name="video_length" value="{{ old('video_length', isset($lesson_edit->id) ? $lesson_edit->video_length : '') }}">
                                                    @if ($errors->has('video_length'))
                                                    <span class="text-danger">{{ $errors->first('video_length') }}</span>
                                                    @endif
												</div>
												<div class="col-3 mb-2 inputbox" id="" style="<?php if(isset($lesson_edit->lesson_type) && $lesson_edit->lesson_type == 'training'){ echo "display:block"; } ?>">
													<label class="form-label" for="">PDF</label>
													<input type="file" class="form-control" id=""  name="pdf" value="">
													<?php 
													$pdf = old('pdf', isset($lesson_edit->id) ? $lesson_edit->pdf : '');
													if($pdf){
													    echo "<a href='".$pdf."' target='_blank'>Uploaded PDF</a>";
													}
													?>
                                                    @if ($errors->has('pdf'))
                                                    <span class="text-danger">{{ $errors->first('pdf') }}</span>
                                                    @endif
												</div>
											
                                                <div class="col-3 mb-2" id="quiz" style="<?php if(isset($lesson_edit->lesson_type) && $lesson_edit->lesson_type == 'assessment'){ echo "display:block"; } ?>">
													<label class="form-label" for="">Select Quiz</label>
													 <select class="form-select" name="quiz_id">
														<option value="0">Select Quiz</option>
                                                        @foreach($quiz as $quizs )
                                                    <option value="{{ $quizs->id }}" @if( old('quiz_id') == $quizs->id ||  isset($lesson_edit->quiz_id)
                                                        &&
                                                        $lesson_edit->quiz_id == $quizs->id ) selected @endif>{{ $quizs->quiz_name }}</option>
                                                    @endforeach
													</select>
                                                    @if ($errors->has('lesson_type'))
                                                   <span class="text-danger">{{ $errors->first('lesson_type') }}</span>
                                                  @endif
												</div>
												
												<div class="col-3 mb-2">
													<label class="form-label" for="">Enter Lesson Order</label>
													<input type="text" class="form-control validatePrice" id="" placeholder="Enter Lessons Order" name="order"
                                                        value="{{ old('order', isset($lesson_edit->id) ? $lesson_edit->order : '') }}" required>
                                                        @if ($errors->has('order'))
                                                    <span class="text-danger">{{ $errors->first('order') }}</span>
                                                    @endif
												</div>
									 
										        <div class="col-12 inputbox mb-2" id="" style="<?php if(isset($lesson_edit->lesson_type) && $lesson_edit->lesson_type == 'training'){ echo "display:block"; } ?>">
									            	<label class="form-label" for="">Structured Transcript</label>
    									    	    <div id="snow-editor">
                                                         <?php echo  old('structured_transcript', isset($lesson_edit->id) ? $lesson_edit->structured_transcript : '') ?>
                                                    </div> 
                                                     <input type="hidden" name="structured_transcript" id="structured_transcript" value="{{ old('structured_transcript', isset($lesson_edit->id) ? $lesson_edit->structured_transcript : '') }}">
                                                </div> 
                                                
                                                <div class="col-12 inputbox" id="" style="<?php if(isset($lesson_edit->lesson_type) && $lesson_edit->lesson_type == 'training'){ echo "display:block"; } ?>">
                                                	<label class="form-label" for="">Key Points</label>
    									    	    <div id="snow-editor-2">
                                                        <?php echo old('key_points', isset($lesson_edit->id) ? $lesson_edit->key_points : '') ?>
                                                    </div> 
                                                    <input  type="hidden" name="key_points" id="key_points" value="{{ old('key_points', isset($lesson_edit->id) ? $lesson_edit->key_points : '') }}">
                                                </div> 
										 
												<!-- <div class="col-2 mb-2">
													<label class="form-label" for="">&nbsp;</label>
													<button type="submit" class="btn btn-primary btn-dark form-control">@if(isset($lesson_edit->id))
                                                      Edit Lessons @else Add Lessons @endif</button>
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
                                                            <td> <input type="datetime-local"
                                                            class="form-control datetimepicker" id="date"
                                                            name="release_date[]" value="{{$m_ship->release_date}}">
                                                            @if($key == 0)
                                                        <div class="pt-2">
                                                            <input type="checkbox" id="apply_to_all">
                                                            <label for="apply_to_all">Same for all</label>
                                                        </div>
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
                                    <label class="form-label" for="">&nbsp;</label>
													<button type="submit" class="btn btn-primary btn-dark form-control">@if(isset($lesson_edit->id))
                                                      Edit Lessons @else Add Lessons @endif</button>
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
                                                <h4 class="mb-3 header-title mt-0">All Lessons</h4>
                                            </div>
                                            <div class="col-6" style="text-align:right;">
                                                <a href="{{route('admin.export_lesson')}}" class="btn btn-primary btn-dark mb-3">Export CSV</a>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-dark mb-3">Import CSV</button>
                                            </div>
                                        </div>
                                        <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th width="20">Sr. No.</th>
                                                    <th>Lesson</th>
													<th>Lesson Type</td>
                                                    <th>Phase</th>
                                                    <th>Part</th> 
													<th>Video ID/Quiz</td>
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
                <form method="post" action="{{ route('admin.import_lesson') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-12 form-group mb-3">
                            <label class="form-label">Upload Lesson CSV File</label>
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
@section('dash-footer')

<link href="<?php echo URL("/") ?>/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo URL("/") ?>/assets/libs/quill/quill.min.js"></script>

        <!-- Init js -->
<script src="<?php echo URL("/") ?>/assets/js/pages/form-editor.init.js"></script>  

@endsection
@section('auth-footer')

<script>
$(function() {
    var table = $('#tables').DataTable({
        processing: true,
        serverSide: true,
        "destroy": true,
        language:{paginate:{previous:"<i class='uil uil-angle-left'>",next:"<i class='uil uil-angle-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")},
        "columnDefs": [{
        "defaultContent": "",
        "targets": "_all"
    }],
        ajax: "{{ route('admin.lesson') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'lesson_name'
            },
            {
                data: 'lesson_type'
            },
            {
                data: 'name'
            },
            {
                data: 'pname'
            }, 
            {
                data: 'quiz_name',
                defaultContent: ''
            },
            {
                data: 'order'
            },
            {
                data: 'action'
            }
        ]
    });

    // $("#tables").dataTable().fnDestroy();
});



$(document).ready(function() {
    $('select').on('change', function() {
        if (this.value === 'training') {
            $('.inputbox').show()
            $('#quiz').hide()
           
        }
    });
});

$(document).ready(function() {
    $('select').on('change', function() {
        if (this.value === 'assessment') {
            $('#quiz').show()
            $('.inputbox').hide()
           
        }
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
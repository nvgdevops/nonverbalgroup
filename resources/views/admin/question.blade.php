@extends('layout.main')
@section('title','Question')
@section('main-container')

<?php

use App\Models\Quiz;

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
                                    <h4 class="page-title">Quiz</h4>
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
										<h4 class="mb-3 header-title mt-0">@if(isset($question_edit->id)) Edit Question @else Add New Question 
                                         @endif</h4>
                                        <form  action="{{ isset($question_edit->id) ? '/admin/question_edit/' .request()->route('quiz_id'). '/' . $question_edit->id : '/admin/question' }}"
                                        method="post">
                                        @csrf
                                        @if(isset($question_edit->id))
                                        @method('PATCH')
                                        @endif

                                        <?php 
                                        
                                        $quiz_name = Quiz::where('id','=',request()->route('quiz_id'))->get()->first();
                                         $name = $quiz_name->quiz_name;

                                        
                                        
                                        
                                        ?>


											<div class="row">
												<div class="col-3">
													<label class="form-label" for="">Quiz Name</label>
													<input type="text" class="form-control" id="" value="{{$name}}" readonly disabled>
												</div>
												<div class="col-3">
													<label class="form-label" for="">Enter Question</label>
                                                    <input type="hidden" name="quiz_id" id="quiz_id"
                                                    value=" {{ request()->route('quiz_id') }}">
													<input type="text" class="form-control" id="" placeholder="Enter Quiz name" name="question"
                                                    value="{{ old('question', isset($question_edit->id) ? $question_edit->question : '') }}">
                                                    @if ($errors->has('question'))
                                                <span class="text-danger">{{ $errors->first('question') }}</span>
                                                @endif
												</div>
												<div class="col-3">
													<label class="form-label" for="">Question Type</label>
													<select class="form-select" name="question_type">
                                                    <option value="">Select Quiz Type </option>
                                                <option value="answer" @if( old('question_type')=='answer' ||
                                                    isset($question_edit->question_type) &&
                                                    $question_edit->question_type == 'answer') selected @endif >Answer
                                                </option>
                                                <option value="ranking" @if( old('question_type')=='ranking' ||
                                                    isset($question_edit->question_type) &&
                                                    $question_edit->question_type == 'ranking') selected @endif>Ranking
                                                </option>
                                                <option value="multiple" @if( old('question_type')=='multiple' ||
                                                    isset($question_edit->question_type) &&
                                                    $question_edit->question_type == 'multiple') selected @endif
                                                    >Multiple choices</option>

                                            </select>
                                            @if ($errors->has('question_type'))
                                            <span class="text-danger">{{ $errors->first('question_type') }}</span>
                                            @endif
												</div>

                                            	<div class="col-12 mt-2">
													<label class="form-label" for="">More Information</label>
                                                    
													<textarea type="text" class="form-control" id=""  name="more_information"
                                                    >{{ old('more_information', isset($question_edit->id) ? $question_edit->more_information : '') }}</textarea>
                                                    @if ($errors->has('more_information'))
                                                <span class="text-danger">{{ $errors->first('more_information') }}</span>
                                                @endif
												</div>
                                        <div class="form-group mt-2" id="radio">
                                            <div class="d-flex">
                                            <input type="text"  class="form-control w-auto float-lg-start" id="inputradio" value="" />
                                            <button id="btn-radio" class='btn btn-success btn-sm'><i class="uil uil-plus"></i></button>
                                            </div>

                                        </div>



                                        <!-- CheckBox -->

                                        <div class="form-group mt-2" id="checkbox">
                                            <div class="d-flex">
                                            <input type="text" class="form-control w-auto float-lg-start" id="txtAdd" value="" />
                                            <button id="btn1" class='btn btn-success btn-sm'><i class="uil uil-plus"></i></button>
                                            </div>
                                        </div>
                                                
												<div class="col-2">
													<label class="form-label" for="">&nbsp;</label>
													<button type="submit" class="btn btn-primary btn-dark form-control"> @if(isset($question_edit->id)) Edit Question @else Add Question
                                                @endif</button>
												</div>
											</div>
                                        </form>
									</div>
								</div>
							</div>
							
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<h4 class="mb-3 header-title mt-0">All Questions</h4>
                                        <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th width="20">Sr. No.</th>
                                                    <th>Question</th>
													<th width="80">Question Type</th>
													<th width="80">Quiz Title</th>
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
    var quiz_id = $("#quiz_id").val();
    var table = $('#tables').DataTable({
        
        processing: true,
        serverSide: true,
        language:{paginate:{previous:"<i class='uil uil-angle-left'>",next:"<i class='uil uil-angle-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")},
        "destroy": true,
        ajax: "<?php echo URL("/") ?>/admin/question/"/quiz_id/0,
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'question',



            },
            {
                data: 'question_type',



            },
            {
                data: 'quiz_name',



            },

            {
                data: 'action',

            },

        ]
    });

    // $("#tables").dataTable().fnDestroy();
});
</script>
 
<script>
 
$(document).ready(function() {
    $('select').on('change', function() {
        if (this.value === 'ranking') {
            $('#radio').show()
            $('#textarea').hide()
            $('#checkbox').hide()
        }
        if (this.value === 'multiple') {
            $('#checkbox').show()
            $('#textarea').hide()
            $('#radio').hide()
        }
        
        if (this.value === 'answer') {
            $('#checkbox').hide()
            $('#textarea').hide()
            $('#radio').hide()
        }
    });
});
 
</script>
<script>
$(function() {
    // Variable to get ids for the checkboxes
    var idCounter = 1;
    $("#btn1").click(function(event) {
        event.preventDefault();
        var val = $("#txtAdd").val();
        if(val != ''){
        $("#checkbox").append("<div class='' id='addRow'> <input  class='' name='correct_answer[]' id='chk_" +
            idCounter + "' type='checkbox' class='' value='" + val + "'  /> <label class='' for='chk_" +
            idCounter + "'>" + val + "</label> <input name='answer[]' type='hidden' value='" + val +
            "' /><a href='#' id='addR' class><em class='uil uil-trash-alt'></em></a></div> "
            );
        var val = $("#txtAdd").val('');
        idCounter++;
        }
    });
});

$(document).on('click', '#addR', function(event) {
    event.preventDefault();
    $(this).parents("#addRow").remove();
})
  
$(function() {
   
    var idCounter = 1;
    $("#btn-radio").click(function(event) {
        event.preventDefault();
        var val = $("#inputradio").val();
       

        if(val != ''){
        $("#radio").append("<div class=''  id='addRow'><input class='' name='correct_answer[]' id='chk_" +
            idCounter + "' type='radio' class='' value='" + val + "' /><label class='' for='chk_" + idCounter + "'>" +
            val + "</label><input class='' name='answer[]' type='hidden' value='" + val +
            "' /><a id='addR' href='#' ><em class='uil uil-trash-alt'></em></a></div>");
        var val = $("#inputradio").val('');
        idCounter++;
        }
    });
});
$(document).on('click', '#addR', function(event) {
    event.preventDefault();
    $(this).parents("#addRow").remove();
});
</script>
@endsection
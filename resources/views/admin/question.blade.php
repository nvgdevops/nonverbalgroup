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
												
												<div class="col-3">
													<label class="form-label" for="">Enter Question Order</label>
													<input type="text" class="form-control validatePrice" placeholder="Enter Question Order" name="order"
                                                    value="{{ old('order', isset($question_edit->id) ? $question_edit->order : '') }}">
                                                    @if ($errors->has('order'))
                                                        <span class="text-danger">{{ $errors->first('order') }}</span>
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
												
										<?php if(isset($question_edit->question_type) && $question_edit->question_type == 'ranking') { ?>
                                        
                                            <div class="form-group mt-2" id="radio" style="display:block;">
                                                <div class="d-flex">
                                                    <input type="text"  class="form-control w-auto float-lg-start" id="inputradio" value="" />
                                                    <button id="btn-radio" class='btn btn-success btn-sm'><i class="uil uil-plus"></i></button>
                                                </div>
                                                
                                                <?php 
                                                
                                                    if(isset($question_edit->answer) && $question_edit->answer != 'null') {
                                                    
                                                        $correct_ans = array();
                                                    
                                                        if(isset($question_edit->correct_answer) && $question_edit->correct_answer != '' && $question_edit->correct_answer != 'null') {
                                                            $correct_ans = json_decode($question_edit->correct_answer, true);
                                                        }
                                                    
                                                        $ans = json_decode($question_edit->answer, true);
                                                        
                                                        $idRadioCounter = 1;
                                                        
                                                        foreach($ans as $key => $value) {
                                                ?>    
                                                            <div class='addRow' id='addRow'> 
                                                                <input  class='' name='correct_answer[]' id='chk_<?php echo ($key + 1); ?>' type='radio' <?php if(in_array($value,$correct_ans)) { echo 'checked'; } ?> class='' value='<?php echo $value; ?>'  /> 
                                                                <label class='' for='chk_<?php echo ($key + 1); ?>'><?php echo $value; ?></label> 
                                                                <input name='answer[]' type='hidden' value='<?php echo $value; ?>' />
                                                                <a href='#' id='addR' class><em class='uil uil-trash-alt'></em></a>
                                                            </div>
                                                <?php
                                                
                                                            $idRadioCounter++;
                                                        }
                                                    }
                                                ?>
                                                
                                            </div>
                                        
                                        <?php } else { ?>
                                        
                                            <div class="form-group mt-2" id="radio">
                                                <div class="d-flex">
                                                    <input type="text"  class="form-control w-auto float-lg-start" id="inputradio" value="" />
                                                    <button id="btn-radio" class='btn btn-success btn-sm'><i class="uil uil-plus"></i></button>
                                                </div>
                                            </div>
                                        
                                        <?php } ?>		
										



                                        <!-- CheckBox -->

                                        <?php if(isset($question_edit->question_type) && $question_edit->question_type == 'multiple') { ?>
                                        
                                            <div class="form-group mt-2" id="checkbox" style="display:block;" >
                                                <div class="d-flex">
                                                    <input type="text" class="form-control w-auto float-lg-start" id="txtAdd" value="" />
                                                    <button id="btn1" class='btn btn-success btn-sm'><i class="uil uil-plus"></i></button>
                                                </div>
                                                
                                                <?php 
                                                
                                                    if(isset($question_edit->answer) && $question_edit->answer != 'null') {
                                                    
                                                        $correct_ans = array();
                                                    
                                                        if(isset($question_edit->correct_answer) && $question_edit->correct_answer != '' && $question_edit->correct_answer != 'null') {
                                                            $correct_ans = json_decode($question_edit->correct_answer, true);
                                                        }
                                                    
                                                        $ans = json_decode($question_edit->answer, true);
                                                        
                                                        $idCheckCounter = 1;
                                                        
                                                        foreach($ans as $key => $value) {
                                                ?>
                                                            <div class='addRow' id='addRow'> 
                                                                <input  class='' name='correct_answer[]' id='chk_<?php echo ($key + 1); ?>' type='checkbox' <?php if(in_array($value,$correct_ans)) { echo 'checked'; } ?> class='' value='<?php echo $value; ?>'  /> 
                                                                <label class='' for='chk_<?php echo ($key + 1); ?>'><?php echo $value; ?></label> 
                                                                <input name='answer[]' type='hidden' value='<?php echo $value; ?>' />
                                                                <a href='#' id='addR' class><em class='uil uil-trash-alt'></em></a>
                                                            </div>
                                                <?php
                                                
                                                            $idCheckCounter++;
                                                        }
                                                    }
                                                ?>
                                                
                                            </div>
                                        
                                        <?php } else { ?>
                                        
                                            <div class="form-group mt-2" id="checkbox" >
                                                <div class="d-flex">
                                                    <input type="text" class="form-control w-auto float-lg-start" id="txtAdd" value="" />
                                                    <button id="btn1" class='btn btn-success btn-sm'><i class="uil uil-plus"></i></button>
                                                </div>
                                            </div>
                                        
                                        <?php } ?>
                                                
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
                data: 'order',
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

        $('.addRow').remove();

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
    var idCheckCounter = <?php echo isset($idCheckCounter) ? $idCheckCounter : 1; ?>;
    $("#btn1").click(function(event) {
        event.preventDefault();
        var val = $("#txtAdd").val();
        
        if(val != ''){
        $("#checkbox").append("<div class='addRow' id='addRow'> <input  class='' name='correct_answer[]' id='chk_" +
            idCheckCounter + "' type='checkbox' class='' value='" + val + "'  /> <label class='' for='chk_" +
            idCheckCounter + "'>" + val + "</label> <input name='answer[]' type='hidden' value='" + val +
            "' /><a href='#' id='addR' class><em class='uil uil-trash-alt'></em></a></div> "
            );
        var val = $("#txtAdd").val('');
        idCheckCounter++;
        }
    });
});

$(document).on('click', '#addR', function(event) {
    event.preventDefault();
    $(this).parents("#addRow").remove();
})
  
$(function() {
   
    var idRadioCounter = <?php echo isset($idRadioCounter) ? $idRadioCounter : 1; ?>;
    $("#btn-radio").click(function(event) {
        event.preventDefault();
        var val = $("#inputradio").val();
        if(val != ''){
        $("#radio").append("<div class='addRow'  id='addRow'><input class='' name='correct_answer[]' id='chk_" +
            idRadioCounter + "' type='radio' class='' value='" + val + "' /><label class='' for='chk_" + idRadioCounter + "'>" +
            val + "</label><input class='' name='answer[]' type='hidden' value='" + val +
            "' /><a id='addR' href='#' ><em class='uil uil-trash-alt'></em></a></div>");
            var val = $("#inputradio").val('');
            idRadioCounter++;
        }
    });
});
$(document).on('click', '#addR', function(event) {
    event.preventDefault();
    $(this).parents("#addRow").remove();
});
</script>
@endsection
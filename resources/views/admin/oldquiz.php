@extends('layout.main')
@section('title','Membership')
@section('main-container')
<style>
#textarea{display: none;}
#checkbox{display: none;}
#radio{display: none;}
</style>
<div class="nk-content">





    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
            @if(session('success'))
                            <h6 class="alert alert-success text-center">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </h6>
                            @endif   


                <div class="nk-block">

                    <div class="row g-gs">
                        <div class="col-lg-5 col-xxl-12">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">  @if(isset($quiz_edit->id)) Edit Quiz @else Add Quiz @endif</h4>

                                </div>
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <form action="{{ isset($quiz_edit->id) ? '/admin/edit_quiz/' . $quiz_edit->id : '' }}" method="post">
                                    @csrf
                                        @if(isset($quiz_edit->id))
                                        @method('PATCH')
                                        @endif
                                        <div class="form-group">
                                            <label class="form-label" for="name">Quize Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg"
                                                    placeholder="Enter Quize name" name="quiz_name" value="{{ old('quiz_name', isset($quiz_edit->id) ? $quiz_edit->quiz_name : '') }}">
                                                @if ($errors->has('quiz_name'))
                                                <span class="text-danger">{{ $errors->first('quiz_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('Quize Type')}}</label>
                                            <select type="text" name="quiz_type" class="form-control selectric" id="select">
                                                <option value="">Select Quize Type </option>
                                                <option value="Answer"  @if( old('quiz_type') == 'Answer' ||  isset($quiz_edit->quiz_type) && $quiz_edit->quiz_type == 'Answer') selected @endif >Answer </option>
                                                <option value="Ranking" @if( old('quiz_type') == 'Ranking' || isset($quiz_edit->quiz_type) && $quiz_edit->quiz_type == 'Ranking') selected @endif>Ranking</option>
                                                <option value="Multiple choices" @if(  old('quiz_type') == 'Multiple choices' || isset($quiz_edit->quiz_type) && $quiz_edit->quiz_type == 'Multiple choices') selected @endif >Multiple choices</option>

                                            </select>
                                            @if ($errors->has('quiz_type'))
                                                <span class="text-danger">{{ $errors->first('quiz_type') }}</span>
                                                @endif
                                        </div>
                                       
                                        <div class="form-group">
                                          <label class="form-label">Answer</label>
                                          <textarea id="textarea" class="form-control" name="ans"  rows="3"></textarea>
                                       </div>
                                        <div class="form-group" id="radio">
                                            <label class="form-label"></label>
                                           
                                           <input type="text"> <input type="radio" name="ans" value="A"> <input type="button" value="Add" id="btnSave" />
                                          
                                        </div>

                                    <div class="form-group" id="checkbox">
                                    <input type="text" id="txtAdd" value="" /> 
<button id="btn1">Click</button>
                                    </div>
                                    <!-- <div id='divContainer'></div>
<input type="text" id="txtAdd" /> 
<button id="btn1">Click</button> -->

                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block"> @if(isset($quiz_edit->id)) Edit Quiz @else Add Quiz @endif</button>
                                        </div>
                                    </form><!-- form -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-xxl-12">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Quiz</h4>

                                </div>
                            </div>
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table id="tables" class="datatable-init nowrap table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Quiz Name</th>
                                                <th>Quiz Type</th>

                                                <th>action</th>
                                            </tr>

                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        ajax: "{{route('admin.quiz')}}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'quiz_name',



            },
            {
                data: 'quiz_type',



            },

            {
                data: 'action',

            },

        ]
    });

    // $("#tables").dataTable().fnDestroy();
});
</script>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
<script>       
    $(document).ready(function () {              
    $('select').on('change', function() {
                    if( this.value === 'Answer') {
                        $('#textarea').show()
                        $('#radio').hide()
                        $('#checkbox').hide()
                    }
                });
    });
    $(document).ready(function () {              
    $('select').on('change', function() {
                    if( this.value === 'Ranking'){
                        $('#radio').show()
                        $('#textarea').hide()
                        $('#checkbox').hide()
                    } 
                });
    });
    $(document).ready(function () {              
    $('select').on('change', function() {
                    if( this.value === 'Multiple choices') {
                        $('#checkbox').show()
                        $('#textarea').hide()
                        $('#radio').hide()
                    }
                });
    });
</script>
<script>
    $(function(){
        // Variable to get ids for the checkboxes
        var idCounter=1;
        $("#btn1").click(function(event){
            event.preventDefault();
            var val = $("#txtAdd").val();
            $("#checkbox").append ( "<label for='chk_" + idCounter + "'>" + val + "</label><input id='chk_" + idCounter + "' type='checkbox' value='" + val + "' />" );
            idCounter ++;
        });
    });
</script>

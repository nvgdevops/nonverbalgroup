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
                        <h4 class="page-title">Quiz Submission Detail</h4>
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
                                        <th>User Name</th>
                                        <td>{{$user_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Quiz</th>
                                        <td>{{$quiz_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Lesson</th>
                                        <td>{{$lesson_name}}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                        <tr>
                                            <td colspan="2">
                                                <div style="font-weight:bold;">Question : {{$row->question}}</div>
                                                <div>
                                                    <b>Answer : </b>
                                                    
                                                @if($row->question_type == 'multiple')
                                                    <?php $ans = json_decode($row->answer,true); ?>
                                                    {{ implode(',',$ans) }}
                                                @else
                                                    {{$row->answer}}
                                                @endif
                                                </div>
                                                
                                                @if(isset($row->correct_answer) && $row->correct_answer != '')
                                                    <div>    
                                                        <b>Correct Answer : </b>
                                                        @if($row->question_type == 'multiple' || $row->question_type == 'ranking')
                                                            <?php $ans = json_decode($row->correct_answer,true); ?>
                                                            {{ implode(',',$ans) }}
                                                        @else
                                                            {{$row->correct_answer}}
                                                        @endif
                                                    </div>
                                                @endif                                                
                                            </td>
                                        </tr>                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

@endsection


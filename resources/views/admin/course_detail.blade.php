@extends('layout.main')
@section('title','Course')
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
                        <h4 class="page-title">Course</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($phase as $key=>$p)
                                    <div class="col-2" style="text-align:center;padding-top:10px;padding-bottom:10px;<?php if($p->id == $ph_id) { echo 'background-color:#000;color:#ffffff;'; } ?>" >
                                        <a style="text-decoration:none;font-weight:bold;<?php if($p->id == $ph_id) { echo 'background-color:#000;color:#ffffff;'; } else { echo 'background-color:#ffffff;color:#000;'; } ?>" href="<?php echo url('admin/course-detail/').'/'.$course->id.'/'.$p->slug; ?>" >{{$p->name}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>


            @foreach($part as $parts)
                
                <h4 class="page-title">{{$parts->name}}</h4>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                    <tbody>
                                    <?php
                                        $lesson = Lesson::where("sub_lesson","=",0)->where('part_id',$parts->id)->where('is_deleted','0')->orderBy('order','ASC')->get();
                                        $id_l = 1;
                                    ?>
                                        @foreach($lesson as $q)
                                            <tr>
                                                <td>{{$id_l}}</td>
                                                <td>{{$q->lesson_name}}</td>
                                                <td>{{$q->lesson_type}}</td>
                                                <td>{{$q->video_length}}</td>
                                            </tr>    
                                            
                                            <?php
                                                $lessons = Lesson::where("sub_lesson",$q->id)->where('part_id',$parts->id)->where('is_deleted','0')->orderBy('order','ASC')->get();
                                                $s_lesson = 1
                                            ?>
                                                @foreach($lessons as $l)
                                                    <tr>
                                                        <td>
                                                            <svg width="12px" style="" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0.856934 0.642853V11.3571H11.6252" stroke="black"></path>
                                                            </svg>
                                                            <span>{{$id_l}}.{{$s_lesson}}</span>
                                                        </td>
                                                        <td>{{$l->lesson_name}}</td>
                                                        <td>{{$l->lesson_type}}</td>
                                                        <td>{{$l->video_length}}</td>
                                                    </tr>    
                                                    <?php $s_lesson++; ?>
                                                @endforeach
                                            
                                            
                                            <?php $id_l++ ?>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                
            @endforeach

        </div> <!-- container -->

    </div> <!-- content -->

    @endsection
    @section('auth-footer')
    <script>
   
    </script>
    @endsection
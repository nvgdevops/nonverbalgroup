@extends('layout.main')
@section('title','Quiz')
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
										<h4 class="mb-3 header-title mt-0"> @if(isset($quiz_edit->id)) Edit Quiz @else Add New Quiz @endif</h4>
                                        <form action="{{ isset($quiz_edit->id) ? '/admin/edit_quiz/' . $quiz_edit->id : '' }}" method="post">
                                        @csrf
                                        @if(isset($quiz_edit->id))
                                        @method('PATCH')
                                        @endif
											<div class="row">
												<div class="col-6">
													<label class="form-label" for="">Enter Quiz Name</label>
													<input type="text" class="form-control" id=""  name="quiz_name" value="{{ old('quiz_name', isset($quiz_edit->id) ? $quiz_edit->quiz_name : '') }}">
                                                    @if ($errors->has('quiz_name'))
                                                <span class="text-danger">{{ $errors->first('quiz_name') }}</span>
                                                @endif
												</div>
												<div class="col-2">
													<label class="form-label" for="">&nbsp;</label>
													<button type="submit" class="btn btn-primary btn-dark form-control"> @if(isset($quiz_edit->id)) Edit Quiz @else Add Quiz @endif</button>
												</div>
											</div>
                                        </form>
									</div>
								</div>
							</div>
							
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<h4 class="mb-3 header-title mt-0">All Quiz</h4>
                                        <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th width="20">Sr. No.</th>
                                                    <th>Quiz Name</th> 
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
    var table = $('#tables').DataTable({
        processing: true,
        language:{paginate:{previous:"<i class='uil uil-angle-left'>",next:"<i class='uil uil-angle-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")},
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
                data: 'action',

            },

        ]
    });

    // $("#tables").dataTable().fnDestroy();
});
</script>

@endsection


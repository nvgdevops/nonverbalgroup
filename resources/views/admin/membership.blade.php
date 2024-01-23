@extends('layout.main')
@section('title','Membership')
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
                                    <h4 class="page-title">Memberships</h4>
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
										<h4 class="mb-3 header-title mt-0">@if(isset($member_edit->id)) Edit Membership @else Add Membership @endif</h4>
                                        <form  action="{{ isset($member_edit->id) ? '/admin/edit_membership/' . $member_edit->id : '' }}" method="post">
                                        @csrf
                                        @if(isset($member_edit->id))
                                        @method('PATCH')
                                        @endif
											<div class="row">
												<div class="col-6">
													<label class="form-label" for="">Enter Membership Name</label>
													<input type="text" class="form-control" id=""  placeholder="Enter Membership Type" name="membership_type" value="{{ old('name', isset($member_edit->id) ? $member_edit->membership_type : '') }}">
                                                    @if ($errors->has('membership_type'))
                                        <span class="text-danger">{{ $errors->first('membership_type') }}</span>
                                        @endif
												</div>
												<div class="col-2">
													<label class="form-label" for="">&nbsp;</label>
													<button type="submit" class="btn btn-primary btn-dark form-control">@if(isset($member_edit->id)) Edit Membership @else Add Membership @endif </button>
												</div>
											</div>
                                        </form>
									</div>
								</div>
							</div>
							
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<h4 class="mb-3 header-title mt-0">All Memberships</h4>
                                        <table id="tables" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th width="20">Sr. No.</th>
                                                    <th>Membership Name</th>
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
        serverSide: true,    "destroy": true,
        ajax: "{{route('admin.membership')}}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'membership_type',
                
               

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
    

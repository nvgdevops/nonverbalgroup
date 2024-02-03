@extends('layout.main')
@section('title','User')
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
                        <h4 class="page-title">Edit User</h4>
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
                            
                            <form action="{{ '/admin/add_user/' }}"
                                method="post">
                                @csrf
                               
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label" for="">Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter name"
                                            name="name"
                                            value="{{ old('name') }}" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4"> 
                                        <label class="form-label" for="">Email</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter email"
                                            name="email"
                                            value="{{ old('email') }}" />
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4"> 
                                        <label class="form-label" for="">Membership</label>
                                        <select name="membership_id" class="form-select">
                                            <option value="">Select Membership</option>';
                                            @foreach($membershipList as $membershipRow)
                                                <option value="{{ $membershipRow['id'] }}" >{{ $membershipRow['membership_type'] }}</option>';
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                    <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->

    </div> <!-- content -->

@endsection
@section('auth-footer')
    <script>
        
    </script>
@endsection
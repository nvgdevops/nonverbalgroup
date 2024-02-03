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
                            
                            <form action="{{ isset($user->id) ? '/admin/edit_user/' . $user->id : '' }}"
                                method="post">
                                @csrf
                                @method('PATCH')
                               
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label" for="">User Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter user name"
                                            name="name"
                                            value="{{ $user->name }}" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4"> 
                                        <label class="form-label" for="">Email</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter email"
                                            name="email"
                                            value="{{ $user->email }}" />
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4"> 
                                        <label class="form-label" for="">Membership</label>
                                        <input type="text" class="form-control" disabled placeholder="Membership"
                                            name="membership_id"
                                            value="{{ $user->membership_type }}" />
                                    </div>

                                </div>
                                <div class="row my-3">
                                    <div class="col-8">
                                        <h4 class="mb-3 header-title mt-0">Phase</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width:5%;">#</th>
                                                    <th scope="col" style="width:55%;">Phase Name</th>
                                                    <th scope="col" style="width:40%;">Release Date</th>

                                                </tr>
                                            </thead>
                                            <?php $id = 1 ?>
                                            @foreach($phase as $value)
                                            <tbody>
                                                <tr>
                                                    <th scope="row">{{$id++}}</th>
                                                    <td>
                                                        {{$value ->	name}} 
                                                        <input type="hidden" name="phase_id[]" value="{{$value->id}}"> 
                                                    </td>
                                                    <td> 
                                                        <input type="datetime-local" class="form-control datetimepicker" id="date"
                                                            name="phase_release_date[]" value=""> 
                                                    </td>
                                                </tr>

                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-8">
                                        <h4 class="mb-3 header-title mt-0">Part</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width:5%;">#</th>
                                                    <th scope="col" style="width:55%;">Part Name</th>
                                                    <th scope="col" style="width:40%;">Release Date</th>

                                                </tr>
                                            </thead>
                                            <?php $id = 1 ?>
                                            @foreach($part as $value)
                                            <tbody>
                                                <tr>
                                                    <th scope="row">{{$id++}}</th>
                                                    <td>
                                                        {{$value ->	name}} 
                                                        <input type="hidden" name="part_id[]" value="{{$value->id}}"> 
                                                    </td>
                                                    <td> 
                                                        <input type="datetime-local" class="form-control datetimepicker" id="date"
                                                            name="part_release_date[]" value=""> 
                                                    </td>
                                                </tr>

                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-8">
                                        <h4 class="mb-3 header-title mt-0">Lesson</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width:5%;">#</th>
                                                    <th scope="col" style="width:55%;">Lesson Name</th>
                                                    <th scope="col" style="width:40%;">Release Date</th>
                                                </tr>
                                            </thead>
                                            <?php $id = 1 ?>
                                            @foreach($lesson as $value)
                                            <tbody>
                                                <tr>
                                                    <th scope="row">{{$id++}}</th>
                                                    <td>
                                                        {{$value ->	lesson_name}} 
                                                        <input type="hidden" name="lesson_id[]" value="{{$value->id}}"> 
                                                    </td>
                                                    <td> 
                                                        <input type="datetime-local" class="form-control datetimepicker" id="date"
                                                            name="lesson_release_date[]" value=""> 
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
                                            class="btn btn-primary btn-dark form-control">Edit</button>
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
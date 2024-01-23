@extends('layout.main')
@section('title','Chapters')
@section('main-container')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">


                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Edit Phase</h4>

                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                        <form action="{{ route('admin.edit_phase', $phase_edit->id) }}" method="post">
                                       
                                        @csrf
                                    @method('PATCH')
                                        <div class="form-group">
                                            <label class="form-label" for="name">Phase Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg" id="name" value="{{ $phase_edit->name }}"
                                                    placeholder="Enter Phase name" name="name">
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block">Update Phase</button>
                                        </div>
                                    </form><!-- form -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="./assets/js/bundle.js?ver=2.5.0"></script>
<script src="./assets/js/scripts.js?ver=2.5.0"></script>
<link rel="stylesheet" href="./assets/css/editors/summernote.css?ver=2.5.0">
<script src="./assets/js/libs/editors/summernote.js?ver=2.5.0"></script>
<script src="./assets/js/editors.js?ver=2.5.0"></script>
@endsection
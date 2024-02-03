@extends('layout.main')
@section('title','Content')
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
                        <h4 class="page-title">@if(isset($edit_content->id)) Edit Content @else Content @endif</h4>
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
                            <h4 class="mb-3 header-title mt-0">Add New Content</h4>
                            <form action="{{ isset($edit_content->id) ? '/admin/content/' . $edit_content->id : '' }}"
                                method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Enter Content Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Content name"
                                            name="name"
                                            value="{{ old('name', isset($edit_content->id) ? $edit_content->name : '') }}" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Enter Class</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Class"
                                            name="class"
                                            value="{{ old('class', isset($edit_content->id) ? $edit_content->class : '') }}" />
                                        @if ($errors->has('class'))
                                        <span class="text-danger">{{ $errors->first('class') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        
                                        <label class="form-label" for="">Select Template Type</label>
                                        <select class="form-select" onchange="templateChange(this.value)" <?php if(isset($edit_content->id)) { echo 'disabled'; } ?> id="" name="template_type">
                                            <option value="">Select Template Type</option>
                                            <option value="container" @if( old('template_type')=='container' ||
                                                isset($edit_content->template_type) && $edit_content->template_type == 'container' ) selected
                                                @endif>container</option>
                                            <option value="video" @if( old('template_type')=='video' ||
                                                isset($edit_content->template_type) && $edit_content->template_type == 'video' ) selected
                                                @endif>video</option>
                                            <option value="practice" @if( old('template_type')=='practice' ||
                                                isset($edit_content->template_type) && $edit_content->template_type == 'practice' ) selected
                                                @endif>practice</option>
                                            <option value="pdf" @if( old('template_type')=='pdf' ||
                                                isset($edit_content->template_type) && $edit_content->template_type == 'pdf' ) selected
                                                @endif>pdf</option>

                                        </select>
                                        @if ($errors->has('template_type'))
                                        <span class="text-danger">{{ $errors->first('template_type') }}</span>
                                        @endif
                                    </div>
                                
                                    <div class="col-4 mb-3">
                                        <label style="margin-top:25px;margin-right:5px;" class="form-label" for="">Button?</label>
                                        <input type="checkbox" style="height:15px;width:15px;" name="is_button"
                                            <?php if(isset($edit_content->is_button) && $edit_content->is_button == 1) { echo 'checked'; } ?> />
                                            
                                        @if ($errors->has('is_button'))
                                        <span class="text-danger">{{ $errors->first('is_button') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Button Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Button Name"
                                            name="button_name"
                                            value="{{ old('button_name', isset($edit_content->id) ? $edit_content->button_name : '') }}" />
                                        @if ($errors->has('button_name'))
                                        <span class="text-danger">{{ $errors->first('button_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label" for="">Button URL</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Button URL"
                                            name="button_url"
                                            value="{{ old('button_url', isset($edit_content->id) ? $edit_content->button_url : '') }}" />
                                        @if ($errors->has('button_url'))
                                        <span class="text-danger">{{ $errors->first('button_url') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row template" id="container" style="display:<?php if(isset($edit_content->template_type) && $edit_content->template_type == 'container') { echo 'block'; } else { echo 'none'; } ?>;" >
                                    <div class="col-12">
                                        <input type="hidden" name="container_title[]" value="note-codable">
                                        <input type="hidden" name="container_detail['note-codable']" id="container_content" value="<?php if(isset($content_data['note-codable'])) { echo $content_data['note-codable']; } ?>" />
                                        <div id="snow-editor-3">
                                            <?php if(isset($content_data['note-codable'])) { echo $content_data['note-codable']; } ?>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="row template" id="video" style="display:<?php if(isset($edit_content->template_type) && $edit_content->template_type == 'video') { echo 'block'; } else { echo 'none'; } ?>;" >
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="">Wistia ID</label>
                                        <input type="hidden" name="video_title[]" value="wistia_id">
                                        <input type="text" class="form-control" value="<?php if(isset($content_data['wistia_id'])) { echo $content_data['wistia_id']; } ?>" placeholder="Enter Wistia ID"
                                            name="video_detail['wistia_id']" />
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label style="margin-top:10px;margin-right:5px;" class="form-label" for="">Comment?</label>
                                        <input type="hidden" name="video_title[]" value="comment">
                                        <input type="checkbox" style="height:15px;width:15px;" <?php if(isset($content_data['comment']) && $content_data['comment'] == 'on') { echo 'checked'; } ?> name="video_detail['comment']" />
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label style="margin-top:10px;margin-right:5px;" class="form-label" for="">Summary?</label>
                                        <input type="hidden" name="video_title[]" value="summary">
                                        <input type="checkbox" style="height:15px;width:15px;" <?php if(isset($content_data['summary']) && $content_data['summary'] == 'on') { echo 'checked'; } ?> name="video_detail['summary']" />
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" name="video_title[]" value="note-codable">
                                        <input type="hidden" name="video_detail['note-codable']" id="video_content" value="<?php if(isset($content_data['note-codable'])) { echo $content_data['note-codable']; } ?>" />
                                        <div id="snow-editor-4">
                                            <?php if(isset($content_data['note-codable'])) { echo $content_data['note-codable']; } ?>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="row template" id="practice" style="display:<?php if(isset($edit_content->template_type) && $edit_content->template_type == 'practice') { echo 'block'; } else { echo 'none'; } ?>;" >
                                    <div class="col-12">
                                        <label class="form-label" for="">Select Practice Theme</label>
                                        <input type="hidden" name="practice_title[]" value="practice_theme">
                                    </div>
                                    <div class="col-12">
                                        <input type="radio" style="height:15px;width:15px;" value="Popup Question Practice Template" <?php if(isset($content_data['practice_theme']) && $content_data['practice_theme'] == 'Popup Question Practice Template') { echo 'checked'; } ?> name="practice_detail['practice_theme']" />
                                        <label style="margin-top:10px;margin-left:5px;" class="form-label" for="">Popup Question Practice Template</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="radio" style="height:15px;width:15px;" value="Embedded Question Practice Template" <?php if(isset($content_data['practice_theme']) && $content_data['practice_theme'] == 'Embedded Question Practice Template') { echo 'checked'; } ?> name="practice_detail['practice_theme']" />
                                        <label style="margin-top:5px;margin-left:5px;" class="form-label" for="">Embedded Question Practice Template</label>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="">Wistia ID</label>
                                        <input type="hidden" name="practice_title[]" value="wistia_id">
                                        <input type="text" class="form-control" value="<?php if(isset($content_data['wistia_id'])) { echo $content_data['wistia_id']; } ?>" placeholder="Enter Wistia ID"
                                            name="practice_detail['wistia_id']" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="">Content Length</label>
                                        <input type="hidden" name="practice_title[]" value="content_length">
                                        <input type="text" class="form-control" value="<?php if(isset($content_data['content_length'])) { echo $content_data['content_length']; } ?>" placeholder="Enter Content Length"
                                            name="practice_detail['content_length']" />
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" name="practice_title[]" value="note-codable">
                                        <input type="hidden" name="practice_detail['note-codable']" id="practice_content" value="<?php if(isset($content_data['note-codable'])) { echo $content_data['note-codable']; } ?>" />
                                        <div id="snow-editor-5">
                                            <?php if(isset($content_data['note-codable'])) { echo $content_data['note-codable']; } ?>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="row template" id="pdf" style="display:<?php if(isset($edit_content->template_type) && $edit_content->template_type == 'pdf') { echo 'block'; } else { echo 'none'; } ?>;" >
                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="">Name Of PDF</label>
                                        <input type="hidden" name="pdf_title[]" value="pdf_name">
                                        <input type="text" class="form-control" id="" placeholder="Enter Name Of PDF"
                                            name="pdf_detail['pdf_name']" />
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="form-label" for="">Size</label>
                                        <input type="hidden" name="pdf_title[]" value="pdf_size">
                                        <input type="text" class="form-control" id="" placeholder="3" value="0"
                                            name="pdf_detail['pdf_size']" />
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="form-label" for="">Number Of Pages</label>
                                        <input type="hidden" name="pdf_title[]" value="pdf_page">
                                        <input type="text" class="form-control" id="" placeholder="3" value="0"
                                            name="pdf_detail['pdf_page']" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="">Link Of PDF</label>
                                        <input type="hidden" name="pdf_title[]" value="pdf_link">
                                        <input type="text" class="form-control" id="" placeholder="Enter Link Of PDF"
                                            name="pdf_detail['pdf_link']" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="">Description Of PDF</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" name="pdf_title[]" value="pdf_description">
                                        <input type="hidden" name="pdf_detail['pdf_description']" id="pdf_description" value="<?php if(isset($content_data['pdf_description'])) { echo $content_data['pdf_description']; } ?>" />
                                        <div id="snow-editor-6">
                                            <?php if(isset($content_data['pdf_description'])) { echo $content_data['pdf_description']; } ?>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="row my-3">
                                    <div class="col-6">
                                    <label class="form-label" for="">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-dark form-control">@if(isset($edit_content->id))
                                            Edit @else Add @endif</button>
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
    @section('dash-footer')

        <link href="<?php echo URL("/") ?>/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo URL("/") ?>/assets/libs/quill/quill.min.js"></script>
        <!-- Init js -->
        <script src="<?php echo URL("/") ?>/assets/js/pages/form-editor.init.js"></script>  

    @endsection
    
    @section('auth-footer')
    <script>
    
        function templateChange(val) {
            $('.template').hide();
            $('#' + val).show();
        }
    
    </script>
    @endsection
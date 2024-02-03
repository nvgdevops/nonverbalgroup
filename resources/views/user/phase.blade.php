@extends('userlayout.main')
@section('title','Phase')
@section('main-container')
<?php 
use App\Models\Lesson;
?>
<div class="main-inner">
      <main class="main-wrapper">
        <div class="section_course-hero">
          <div class="padding-global">
            <div class="container-large">
              <div class="padding-section-medium">
                <div class="home_header_component">
                  <div id="title-header"><div class="grid-auto-column align-left"><div class="label-size-regular">PHASE</div><div class="label-size-regular">1</div></div>@foreach($phase_name as $l)<h1 class="heading-style-h1 text-color-black margin-bottom margin-xsmall">{{$l->name}}</h1>@endforeach<div w-el="coursesummary" class="text-size-regular text-color-black">Our onboarding is designed to set you up powerfully so you understand and make the most use of the underlying structures that will create your social transformation. You will complete several assessments designed to capture where your current social skills are and help us understand your goals and motivations. </div></div>
                  <div id="w-node-_94308131-ac9a-b318-174c-a373a98dda6a-7e6126da" class="w-dyn-list">
                    <div role="list" class="w-dyn-items">
                      <div role="listitem" class="align-left w-dyn-item">
                        <!--<a href="#start" class="button is-icon w-inline-block">
                          <div class="label-size-regular">Start course</div>
                          <div id="w-node-_2cf6f738-984e-2e20-00e3-ca8a9ba843a8-7e6126da" class="icon-arrow">
                            <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 22 11" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_515_911)">
                                  <path d="M17 0L16.21 0.72L20.1 5H0V6H20.1L16.21 10.28L16.72 11L22 5.5L17 0Z" fill="currentColor"></path>
                                </g>
                                <defs>
                                  <clippath id="clip0_515_911">
                                    <rect width="22" height="11" fill="currentColor"></rect>
                                  </clippath>
                                </defs>
                              </svg></div>
                          </div>
                        </a> -->
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
           <div class="div-block-16">
            <div class="div-block-15">
                 <div class="">
            <div class="container-large">
              <div class="nav_burger background-color-black" onclick="$('.ml').toggle();">
              <div class="menu-line ml"></div>
              <div class="menu-line ml"></div>
              <div class="menu-line ml"></div>
              <div class="cross ml" style="display:none;">
                  <svg width="23" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:#FFF;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title/><g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"/><line class="cls-1" x1="7" x2="25" y1="25" y2="7"/></g></svg>
              </div>
            </div>
            </div>
            </div>
            </div>
          </div>
            
          </div>
          <div class="background-wrapper">
            <div class="bg-video w-embed">
              <div class="video-cover">
                <video width="100%" muted="" autoplay="" playsinline="" loop="" data-object-fit="cover">
                  <source src="https://assets-global.website-files.com/6477958971ec2048ea86cf88/6529992968685d1ce415d60e_japanese-blake-movie-transcode.mp4" type="video/mp4">
                  <source src="https://assets-global.website-files.com/6477958971ec2048ea86cf88/6529992968685d1ce415d60e_japanese-blake-movie-transcode.mp4" type="video/webm">
                  Your browser doesn't support HTML5 video tag.
                </video>
              </div>
              <style>
video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.video-cover video {
  object-fit: cover;
}
.per_cell{
    width:105px;
}
</style>
<?php  //href="{{route('detail_phase',$phaseslug->slug)  }}"  ?>
            </div>
          </div>
        </div>
        
        <div class="section_belt">
          <div class="padding-global">
            <div class="container-large">
              <div class="subnav-container --centered">
                <div class="div-block-10">
                  <div class="w-layout-grid grid-3">
                    <?php 
                    $total_phase = $phase->count();
                    ?>
                    @foreach($phase as $key=>$p)
                    <a href="{{route('phase',$p->slug)  }}" class="div-block-14 link w-inline-block --block">
                      <div class="label-size-small <?php if ($p->slug == $l['slug'] ) echo 'red'; ?>">{{$p->name}}</div>
                      <div class="divider"></div>
                      <div class="div-block-11">
                        <div class="div-block-12">
                          <div class="div-block-13 <?php if ($p->slug == $l['slug'] ) echo 'red'; ?> <?php if ($p->slug == $l['slug'] ) echo '--grey'; ?>"></div>
                        </div>
                      </div>
                    </a>
                    @if($total_phase != $key+1)
                    <div id="w-node-_51779d9a-336a-3246-1dd5-0f576fa88950-69f85cea" class="div-block-11">
                      <div class="div-block-12"></div>
                    </div>
                    @endif
                      @endforeach
                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section_belt hide">
          <div class="padding-global">
            <div class="container-large">
              <div class="subnav-container"></div>
              <div class="w-dyn-list">
                <div role="list" class="collection-list-2 w-dyn-items">
                @foreach($phase as $p)
                  <div role="listitem" class="collection-item-2 w-dyn-item phase-details">
                    <a href="{{route('phase',$p->slug)  }}" class="full-width w-inline-block">
                      <div data-hover="true" data-delay="200" class="phase-link w-dropdown">
                        
                        <div class="phase-toggle w-dropdown-toggle">
                          <div class="phase-link-content">
                            <div class="grid-auto-column">
                              <div class="label-size-small">{{$p->name}}</div>
                              <div class="label-size-small"></div>
                            </div>
                            <div class="dot"></div>
                          </div>
                        </div>
                       
                        <nav class="phase-link-message w-dropdown-list">
                          <div class="message-wrapper">
                            <div class="grid-auto-column align-left">
                              <div class="label-size-regular">{{$p->name}}</div>
                              <div class="label-size-regular"></div>
                            </div>
                            <div class="text-size-regular"></div>
                          </div>
                        </nav>
                      </div>
                    </a>
                  </div>
                  
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="w-dyn-list">
          <div role="list" class="w-dyn-items">
          @foreach($part as $parts)
            <div role="listitem" class="w-dyn-item">
              <a href="#" class="hide w-inline-block"></a>
              <div>
                
                <div id="start" class="section">
                  <div class="padding-global">
                    <div class="container-large">
                      <div class="padding-section-medium padding-top">
                        <div class="section-header">
                          <h2 class="label-size-big">{{$parts->name}}</h2>
                          <div class="info-row">
                            <div class="icon-1x1-small">
                              <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <g clip-path="url(#Icon_clip0-469-2097)">
                                    <path d="M9.00011 16.5294C13.1585 16.5294 16.5295 13.1584 16.5295 9C16.5295 4.84162 13.1585 1.47059 9.00011 1.47059C4.84174 1.47059 1.4707 4.84162 1.4707 9C1.4707 13.1584 4.84174 16.5294 9.00011 16.5294Z" stroke="black"></path>
                                    <path d="M9.0918 3.94301V9.16509L13.1378 12.4028" stroke="black"></path>
                                  </g>
                                  <defs>
                                    <clippath id="Icon_clip0-469-2097">
                                      <rect width="16" height="16" fill="white" transform="translate(1 1)"></rect>
                                    </clippath>
                                  </defs>
                                </svg></div>
                            </div>
                            <div class="label-size-regular no-break">{{$parts->part_length}}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="start" class="section_course-list">
                  <div class="padding-global">
                    <div class="container-large">
                      <div class="padding-section-small">
                        <div w-el="coursestructure" class="content-list">
                          <div>
                          <?php
                                $membership_id = \App\Models\User::find(Auth::id())->membership_id;
                                //$lesson = Lesson::where("sub_lesson","=",0)->where('part_id',$parts->id)->get();
                                $lesson = Lesson::select('lessons.*')
                                        ->leftjoin('releases', 'lessons.id', '=', 'releases.action_id') 
                                        ->where('releases.type','lesson')
                                        ->where('releases.membership_id',$membership_id)
                                        ->where(function ($lesson) {
                                                $lesson->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                                    ->orWhereNull('releases.release_date');
                                            }
                                        )
                                        ->where('lessons.sub_lesson','=',0)
                                        ->where('lessons.part_id',$parts->id)
                                        ->where('lessons.is_deleted','0')
                                        ->orderBy('lessons.order','ASC')
                                        ->get();
                            ?>
                            <?php $id_l = 1 ?>
                            @foreach($lesson as $q)
                            <div class="w-dyn-list">
                              <div role="list" class="collection-list w-dyn-items">
                                <div role="listitem" class="item course_nested-content w-dyn-item">


                                
                                @if($q->lesson_type == 'training')
                                   <a  href="{{route('detail-nested-conten',$q->slug)  }}"  class="link-cms-item w-inline-block">
                                  
                                    @else
                                    <a  href="{{route('quizes',$q->slug)  }}"  class="link-cms-item w-inline-block">
                                    @endif
                                 
                                   <div id="w-node-_550db817-cf08-37e7-05ff-c40400335804-69f85cea" class="w-layout-layout quick-stack wf-layout-layout">
                                      <div id="w-node-_550db817-cf08-37e7-05ff-c40400335805-69f85cea" class="w-layout-cell cell is-title">
                                        <div class="wrapper-link">
                                          <div class="row-header">
                                            
                                            <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769d-7e6126da" class="embed w-embed"> {{$id_l}}</div>
                                            <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769e-7e6126da" class="nested-content_order">
                                              <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769f-7e6126da" class="label-size-regular"></div>
                                            </div>
                                            <h5 class="heading-style-h5">{{$q->lesson_name}}</h5>
                                          </div>
                                        </div>
                                      </div>
                                    <div id="w-node-_550db817-cf08-37e7-05ff-c4040033580c-69f85cea" class="w-layout-cell cell is-full">
                                        <div id="w-node-_550db817-cf08-37e7-05ff-c4040033580d-69f85cea" class="w-layout-layout quick-stack wf-layout-layout">
                                          <div id="w-node-_550db817-cf08-37e7-05ff-c4040033580e-69f85cea" class="w-layout-cell nested-cell hide-mobile-landscape">
                              
                                            <div>
                                                <div class="label-size-regular">{{$q->lesson_type}}</div>
                                            </div>
                                          </div>
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76a6-7e6126da" class="w-layout-cell nested-cell">
                                             
                                                <div> @if($q->lesson_type == 'training')<img src="<?php echo URL("/") ?>/assets/images/icon-video.svg" loading="lazy" alt="" class="course_content-type-icon"> @else <img src="<?php echo URL("/") ?>/assets/images/np_checkbox_2473475_000000.svg" loading="lazy" alt="" class="course_content-type-icon">@endif </div>
                                          </div>
                                          @if($q->lesson_type == 'training')
                                          <?php
                                           $get_video_time = DB::table('video_time')->where('lesson_id',$q->id)->where('user_id', Auth::id())->first();
                                          ?>
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76ab-7e6126da" class="w-layout-cell nested-cell per_cell">
                                            <div class="label-size-regular">@if(isset($get_video_time->w_time)) @if($get_video_time->w_time >= 90 ) <span style="color: grey; text-transform: capitalize;">Completed</span> @else {{$get_video_time->w_time}}% @endif @else 0% @endif  </div>
                                          </div>
                                          @else
                                          
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76ab-7e6126da" class="w-layout-cell nested-cell per_cell">
                                            <div class="label-size-regular">-</div>
                                          </div>
                                          @endif
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76ab-7e6126da" class="w-layout-cell nested-cell">
                                            <div class="label-size-regular">{{$q->video_length}}</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="div-block-3"></div>
                                  </a>

                                  <!-- Second -->
                                  <?php
                                      //$lesson = Lesson::where("sub_lesson",$q->id)->where('part_id',$parts->id)->get();
                                      
                                      $lesson = Lesson::select('lessons.*')
                                        ->leftjoin('releases', 'lessons.id', '=', 'releases.action_id')
                                        ->where('releases.type','lesson')
                                        ->where('releases.membership_id',$membership_id)
                                        ->where(function ($lesson) {
                                                $lesson->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                                    ->orWhereNull('releases.release_date');
                                            }
                                        )
                                        ->where('lessons.sub_lesson',$q->id)
                                        ->where('lessons.part_id',$parts->id)
                                        ->where('lessons.is_deleted','0')
                                        ->orderBy('lessons.order','ASC')
                                        ->get();
                                    ?>
                                  <?php $s_lesson = 1 ?>
                                  @foreach($lesson as $l)
                               
                                   @if($l->lesson_type == 'training')
                                   <a  href="{{route('detail-nested-conten',$l->slug)  }}"  class="link-cms-item w-inline-block">
                                  
                                    @else
                                    <a  href="{{route('quizes',$l->slug)  }}"  class="link-cms-item w-inline-block">
                                    @endif
                                 
                                      <div id="w-node-_05739541-cf03-69d4-5630-701c31ef7699-69f85cea" class="w-layout-layout quick-stack wf-layout-layout">
                                      <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769a-69f85cea" class="w-layout-cell cell is-title">
                                        <div>
                                          <div class="row-header">
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769d-69f85cea" class="embed w-embed"><svg width="12px" style="" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.856934 0.642853V11.3571H11.6252" stroke="black"></path>
</svg></div>
                                            <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769d-7e6126da" class="embed w-embed">{{$id_l}}.{{$s_lesson}}</div>
                                            <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769e-7e6126da" class="nested-content_order">
                                              <div id="w-node-_05739541-cf03-69d4-5630-701c31ef769f-7e6126da" class="label-size-regular"></div>
                                            </div>
                                            <h5 class="heading-style-h5">{{$l->lesson_name}}</h5>
                                          </div>
                                        </div>
                                      </div>
                                        <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76a1-69f85cea" class="w-layout-cell cell is-full">
                                        <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76a2-69f85cea" class="w-layout-layout quick-stack wf-layout-layout">
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76a3-69f85cea" class="w-layout-cell nested-cell hide-mobile-landscape">
                                            <div>
                                            
                                              <div class="label-size-regular">{{$l->lesson_type}}</div>
                                            </div>
                                          </div>
                                           <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76a6-69f85cea" class="w-layout-cell nested-cell">
                                             
                                           
                                            <div> @if($l->lesson_type == 'training')<img src="<?php echo URL("/") ?>/assets/images/icon-video.svg" loading="lazy" alt="" class="course_content-type-icon"> @else <img src="<?php echo URL("/") ?>/assets/images/np_checkbox_2473475_000000.svg" loading="lazy" alt="" class="course_content-type-icon">@endif </div>
                                          </div>
                                           @if($l->lesson_type == 'training')
                                           <?php
                                           $get_video_time = DB::table('video_time')->where('lesson_id',$q->id)->where('user_id', Auth::id())->first();
                                          ?>
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76ab-7e6126da" class="w-layout-cell nested-cell per_cell">
                                            <div class="label-size-regular">@if(isset($get_video_time->w_time)) @if($get_video_time->w_time >= 90 ) <span style="color: grey; text-transform: capitalize;">Completed</span> @else {{$get_video_time->w_time}}% @endif @else 0% @endif  </div>
                                          </div>
                                          @else
                                          <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76ab-7e6126da" class="w-layout-cell nested-cell per_cell">
                                            <div class="label-size-regular">-</div>
                                          </div>
                                          @endif
                                        <div id="w-node-_05739541-cf03-69d4-5630-701c31ef76ab-69f85cea" class="w-layout-cell nested-cell">
                                            <div class="label-size-regular">{{$l->video_length}}</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="div-block-3"></div>
                                  </a>
                                  <?php $s_lesson++ ?>
                                   @endforeach
                                 
                                </div>
                              </div>
                            </div>
                            <?php $id_l++ ?>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
		 
        <div class="hide w-form">
          <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="655b434272e0596d7e6126da" data-wf-element-id="35376261-5964-acaf-5357-921d8f6a1099"><input type="text" class="w-input" maxlength="256" name="User-Email" data-name="User Email" placeholder="Example Text" id="User-Email" w-el="input_quiz_author_name" required=""></form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </main>
    </div>
@endsection
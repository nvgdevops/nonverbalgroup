<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Phase;
use App\Models\Part;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Membership;
use App\Models\Release;
use App\Models\Answer;
use App\Models\AnswerParent;
use App\Models\User;
use DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // dashboard
    public function index()
    {
        $phase =  Phase::count();
        $part =  Part::count();
        $lesson =  Lesson::count();
        $quiz =  Quiz::count();
        $membership =  Membership::count();

        return view('admin.dashboard',compact('phase','part','lesson','quiz','membership'));
    }
    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function User_delete($id)
    {
        $datadel = User::find($id);
        $datadel->delete();
        return redirect()->route('admin.user')
                      ->with('success','Quiz Delete Successfully');
    }
    
    public function User_membership(Request $request)
    {
        $id = $request->id;
        $membership_id = $request->membership_id;
        
        $user = User::find($id);
        $user->membership_id = $membership_id;
        $user->save();
        return redirect()->route('admin.user')
                      ->with('success','Membership Saved Successfully');
    }
    
    public function User(Request $request)
    {
        if($request->ajax()){
          $user = User::where('role','=','1')->get();
          return datatables()->of($user)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              $action = '';
    
              $action.= '<a href="'.url('admin/edit_user',$row->id).'"  Value="Edit User">
                <i class="uil uil-edit"></i>
                </a>
              <form action="'.route('admin.user_delete', $row->id).'" style="display: inline;">
                 <input type="hidden" name="_token" value="'.csrf_token().'">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-link text-danger" class="text-danger" href="#" onclick="return confirm(\'Are you sure you want to delete this Phase?\');"  title="Delete Phase" ><i class="uil uil-trash-alt"></i></button>
              </form>';
           return $action;
              
          })
          ->addColumn('membership', function ($row) {
              
              $membershipList = Membership::get();
              
              $membership = '';
    
              $membership.= '
              <form id="membershipFrom'.$row->id.'" action="'.route('admin.user_membership').'" method="POST" style="display: inline;">
                 <input type="hidden" name="_token" value="'.csrf_token().'">
                  <input type="hidden" name="_method" value="POST">
                  <input type="hidden" name="id" value="'.$row->id.'">
                  <select name="membership_id" onChange="submitMembership('.$row->id.')" class="form-select">
                    <option value="">Select Membership</option>';
                    
                    foreach($membershipList as $membershipRow) {
                        
                        $selected = ($membershipRow['id'] == $row->membership_id) ? 'selected' : '';
                        
                        $membership .= '<option '.$selected.' value="'.$membershipRow['id'].'" >'.$membershipRow['membership_type'].'</option>';
                    }
                    
                  $membership .= '</select>
              </form>';
           return $membership;
              
          })
          ->rawColumns(['action','membership']) 
          ->make(true);
        }

        return view('admin.user');
    }
   
    public function edit_user(Request $request,$id="")
    {
        $phase =  Phase::get();
        $part =  Part::get();
        $lesson =  Lesson::get();
        
        $user = DB::table('users')
            ->select('users.*','memberships.membership_type')
            ->leftjoin('memberships','memberships.id', '=', 'users.membership_id')->where('users.id','=',  $id)->first();
        
        //$user = User::find($id);
        return view('admin.edit_user',compact('user','phase','part','lesson'));
    }
   
    //  Phase view

    public function Phase(Request $request,$id="")
    {
        $phase_edit = [];
        if($request->ajax()){
            
            $query = Phase::join('courses','phases.course_id','=','courses.id')
                 ->select('courses.name as course_name', 'phases.*')->get();
            
            return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/phase',$row->id).'"  Value="Edit Phase">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.phase_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-link text-danger" href="#" onclick="return confirm(\'Are you sure you want to delete this Phase?\');"  title="Delete Phase"><i class="uil uil-trash-alt"></i></button>
                </form>';
             return $action;
                
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
        if($id != ''){
            $phase_edit = Phase::find($id);
             /* $membership = DB::table('memberships')
            ->select('memberships.*','releases.release_date')
            ->leftjoin('releases','releases.membership_id', '=', 'memberships.id')->where('releases.action_id','=',  $phase_edit->id)->where('type','=','phase')->get();
            */
            $membership = Membership::select('memberships.*',DB::raw("(SELECT release_date FROM releases WHERE releases.membership_id = memberships.id AND releases.action_id = $phase_edit->id AND type = 'phase' ORDER BY releases.id DESC LIMIT 1) as release_date"))->get();
        } 
          else{
              $membership = Membership::get();
          }
          
          $course = Course::get();
        return view('admin.phase',compact('phase_edit','membership','course'));
    }
    
    
    public function course(Request $request,$id="")
    {
        $course_edit = [];
        if($request->ajax()){
            return datatables()->of(Course::all())
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/course-detail',$row->id).'" >'.$row->name.'</a>';
             return $action;
                
            })
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/course',$row->id).'"  Value="Edit Course">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.course_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-link text-danger" href="#" onclick="return confirm(\'Are you sure you want to delete this Course?\');"  title="Delete Course"><i class="uil uil-trash-alt"></i></button>
                </form>';
             return $action;
                
            })
            ->rawColumns(['action','name']) 
            ->make(true);
        }
        if($id != ''){
            $course_edit = Course::find($id);
        } 
        return view('admin.course',compact('course_edit'));
    }

   

                        // PART  //

    public function Part(Request $request,$id="")
       {
        $part_edit = [];

        if($request->ajax()){
            // $query = Part::join('phases','parts.phase_id', '=', 'phases.id')
            //      ->select('parts.id', 'parts.name', 'phases.name')
            //      ->get();

                 $query = Part::join('phases','parts.phase_id','=','phases.id')
                 ->select('parts.name as pname', 'phases.name','parts.id')->get();

              return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/part',$row->id).'"  Value="Edit Part">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.part_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-link text-danger" href="#"  onclick="return confirm(\'Are you sure you want to delete this Part?\');"  title="Delete Part" ><i class="uil uil-trash-alt"></i></button>
                </form>';
             return $action;
                
            })
            ->rawColumns(['action']) 
            ->make(true);
        }

        $part = Phase::all();
        
        if($id != ''){
            $part_edit = Part::find($id);
            /*$membership = DB::table('memberships')
          ->select('memberships.*','releases.release_date')
          ->join('releases','releases.membership_id', '=', 'memberships.id')->where('releases.action_id','=',  $part_edit->id)->where('type','=','part')->get(); */
          
          $membership = Membership::select('memberships.*',DB::raw("(SELECT release_date FROM releases WHERE releases.membership_id = memberships.id AND releases.action_id = $part_edit->id AND type = 'part' ORDER BY releases.id DESC LIMIT 1) as release_date"))->get();
          
        } 
        else{
            $membership = Membership::get();
        }
        return view('admin.part',compact('part','part_edit','membership'));
    }

    // membership


    public function Membership(Request $request,$id="")
    {
        $member_edit = [];
        if($request->ajax()){
            return datatables()->of(Membership::all())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/membership',$row->id).'"  Value="Edit Membership">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.membership_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                 <button class="btn btn-link text-danger" class="text-danger" onclick="return confirm(\'Are you sure you want to delete this Membership?\');"  title="Delete Membership" ><i class="uil uil-trash-alt"></i></button>
                </form>';
             return $action; 
                
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
        if($id != ''){
            $member_edit = Membership::find($id);
          } 

        
        return view('admin.membership',compact('member_edit')); 
    }

    // Lesson

    public function Lesson(Request $request,$id="")
       {
        $lesson_edit = [];
        if($request->ajax()){

            $query = Lesson::join('phases','lessons.phase_id','=','phases.id')
                  ->join('parts','lessons.part_id','=','parts.id')
                 
                  ->leftJoin('quizzes','lessons.quiz_id','=','quizzes.id')
                 ->select('lessons.lesson_name', 'phases.name','lessons.lesson_type','lessons.id','parts.name as pname','quizzes.quiz_name','lessons.wistia_video_id')->get();
            return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('lesson_type', function ($row) {
             return ucfirst($row->lesson_type);
            })
             ->addColumn('lesson_name', function ($row) {
                 $html  = '';
                 $html .= Str::limit($row->lesson_name, 30,"...") ;
                //  $html .='<br /><span class="badge badge-outline-primary badge-sm">'.$row->membership_type.'</span>';
             return  $html;
            }) 
            ->addColumn('pname', function ($row) {
             return  Str::limit($row->pname, 20,"...") ;
            })
            ->addColumn('quiz_name', function ($row) {
             return  Str::limit($row->quiz_name, 20,"...").$row->wistia_video_id ;
            })
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/lesson',$row->id).'"  Value="Edit Lesson">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.lesson_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-link text-danger" href="#"  onclick="return confirm(\'Are you sure you want to delete this Lesson?\');"  title="Delete Lesson"><i class="uil uil-trash-alt"></i></button>
                </form>';
             return $action;
                
            })
            ->rawColumns(['action','lesson_name']) 
            ->make(true);
        }

        $part = Part::all();
        $phase =Phase::all();
        $membership = Membership::all();
        $quiz = Quiz::all();
        $lesson = Lesson::all();

        if($id != ''){
            $lesson_edit = Lesson::find($id);
         /*   $membership = DB::table('memberships')
          ->select('memberships.*','releases.release_date')
          ->join('releases','releases.membership_id', '=', 'memberships.id')->where('releases.action_id','=',  $lesson_edit->id)->where('type','=','lesson')->get();
       */
       
       $membership = Membership::select('memberships.*',DB::raw("(SELECT release_date FROM releases WHERE releases.membership_id = memberships.id AND releases.action_id = $lesson_edit->id AND type = 'lesson' ORDER BY releases.id DESC LIMIT 1) as release_date"))->get();
       
       //   dd($membership);
          
        } 
        else{
            $membership = Membership::get();
        }
        return view('admin.lesson',compact('part','phase','membership','lesson_edit','quiz','lesson','membership'));
    }

    // Quiz

    public function Quiz(Request $request,$quiz_id="",$id="")
       {
        $quiz_edit = [];
        if($request->ajax()){
            return datatables()->of(Quiz::all())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
    
                $action.= '<a href="'.url('admin/question',$row->id).'/0" class="btn btn-primary btn-dark btn-sm" Value="Edit question" style=" margin-right: 20px; ">
                Add Question
                <input type="hidden" name="quiz_id" value="{{$row->id}">
                </a>
                <a href="'.url('admin/quiz',$row->id).'"  Value="Edit Quiz">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.route('admin.quiz_delete', $row->id).'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'"> 
                    <input type="hidden" name="_method" value="DELETE">
                   <button class="btn btn-link text-danger" href="#"  onclick="return confirm(\'Are you sure you want to delete this Quiz?\');"  title="Delete Quiz"><i class="uil uil-trash-alt"></i></button>
                    
                </form>';
                
             return $action;
                
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
        if($quiz_id != ''){
            $quiz_edit = Quiz::find($quiz_id);
        } 

        $part = Part::all();
        return view('admin.quiz',compact('quiz_edit','part'));
    }

    public function Question(Request $request,$quiz_id="", $id='')
    {
        // $quiz_id =  request()->route('quiz_id');

        $question_edit = [];
        if($request->ajax()){

            $query = Question::join('quizzes','questions.quiz_id','=','quizzes.id')
            ->select('questions.question','questions.question_type', 'quizzes.quiz_name','questions.id','quizzes.id as qid','questions.id as questions_id')
            ->where('questions.quiz_id','=', $quiz_id)
            ->get();

            return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
 
                $action.= '<a href="'.url('admin/question',$row->qid).'/'.$row->questions_id.'" Value="Edit Question">
                <i class="uil uil-edit"></i>
                </a>
                <form action="'.url('admin/question_delete',$row->questions_id).'/'.$row->qid.'" style="display: inline;">
                   <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-link text-danger" onclick="return confirm(\'Are you sure you want to delete this Quiz?\');"  title="Delete Quiz" ><i class="uil uil-trash-alt"></i></button>
                    
                </form>';
                
                return $action;
                
            })
            ->addColumn('question_type', function ($row) {
               
                
             return ucfirst($row->question_type);
                
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
        if($id != ''){
            $question_edit = Question::find($id);
        } 
          // $quiz_id = Quiz::all();
          // $id = Quiz::all()->get();
        return view('admin.question',compact('quiz_id','question_edit'));
    }
    
    
    // Course Part Start
    
    // add_course

    public function add_course(Request $request)
    {
     $validate = $request->validate([
         'name' => 'required',
         
     ]);
        $course = new Course;
        $pre_slug = '';
        $count_course = Course::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_course > 0){ 
          $pre_slug = "-".$count_course;
        }
        $course->name = $request->name;
        $course->slug = Str::slug($request->name).$pre_slug;
        $course->save();
      
        return redirect()->route('admin.course')->with('success','Course Added SuccessFully...');
    }

    public function edit_course(Request $request, $id)
    {
        $id = $request->id;
        $update = Course::find($id);
        $update->name= $request->name;

        if($update->save())
        {
         return redirect()->route('admin.course')->with('success', 'Course Updated successfully.');
        }
    }
    
    public function course_detail($id, $slug = '')
    {
        $course = Course::find($id);
        $phase = Phase::where('course_id',$id)->first();
        
        if($slug == ''){
            
            $ph = Phase::where('course_id',$id)->get()->first();
                
            if($ph) {
                $slug = $ph->slug;
            }
        }
        
        $phase_id = Phase::where('slug', $slug)->get('id')->first();
        $ph_id = isset($phase_id->id) ? $phase_id->id : 0;

        $lesson = Lesson::all();
        $phase = Phase::all();
        $part = Part::where('phase_id',$ph_id)->get();
        
        return view('admin.course_detail',compact('course','phase','lesson','part','ph_id'));
    }
    
    public function course_delete($id)
    {
        $datadel = Course::find($id);
        $datadel->delete();
        return redirect()->route('admin.course')
                      ->with('success','Course Delete successfully');
    }
                                    // Course  End //

// --------------------------------------------------------------------------------------------------------------------------
    
    
    
    //    Phase Part Start

    // add_phase

    public function add_phase(Request $request)
    {
     $validate = $request->validate([
         'name' => 'required',
         
     ]);
        $phase = new Phase;
        $pre_slug = '';
        $count_lessson = Phase::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $phase->name = $request->name;
        $phase->course_id = isset($request->course_id) ? $request->course_id : 0;
        $phase->phase_title = $request->phase_title;
        $phase->phase_length = $request->phase_length;
        $phase->phase_dec = $request->phase_dec;
        $phase->slug = Str::slug($request->name).$pre_slug;
        $phase->save();

       
        foreach($request->membership_id as $key=>$m_id){
            $relese = new Release;
            $relese->membership_id =  $m_id;
            $relese->release_date = $request->release_date[$key];  
            $relese->action_id = $phase->id;
            $relese->type = 'phase';
            $relese->save();
        }
      
        return redirect()->route('admin.phase')->with('success','Phase Added SuccessFully...');
    }

    public function edit_phase(Request $request, $id)
    {
       
        $id = $request->id;
        $update = Phase::find($id);
        $update->name= $request->name;
        $update->course_id = isset($request->course_id) ? $request->course_id : 0;
        $update->phase_length = $request->phase_length;
        $update->phase_title = $request->phase_title;
        $update->phase_dec = $request->phase_dec;

        if($update->save())
        {
        foreach($request->membership_id as $key=>$m_id){
            
            $r = DB::table('releases')->where('type','phase')->where('action_id',$id)->where('membership_id',$m_id)->get()->first();
            
            if($r) {
                DB::table('releases')->where('type','phase')->where('action_id',$id)->where('membership_id',$m_id)
                ->update(['release_date' => $request->release_date[$key]]);
            } else {
                $relese = new Release;
                $relese->membership_id =  $m_id;
                $relese->release_date = $request->release_date[$key];  
                $relese->action_id = $id;
                $relese->type = 'phase';
                $relese->save();
            }
        }
        
         return redirect()->route('admin.phase')->with('success', 'Phase Updated successfully.');
        }
        
    }
    public function Phase_delete($id)
    {
        $datadel = Phase::find($id);
        $datadel->delete();
        return redirect()->route('admin.phase')
                      ->with('success','Phase Delete successfully');
    }
                                    // Pahse  End //

// --------------------------------------------------------------------------------------------------------------------------

                                    // Part Start //

    public function Add_Part(Request $request)
    {
        $validatedData = $request->validate(
            [
              'name' => 'required',
              'phase_id' => 'required|integer',
            ],
            [
                'phase_id' => 'Please Select Phase' 
            ]
            );
        $pre_slug = '';
        $count_lessson = Part::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $part = new Part;
        $part->name = $request->name;
        $part->part_length= $request->part_length;
        $part->phase_id = $request->phase_id;
        $part->slug = Str::slug($request->name).$pre_slug;
        $part->save();

        foreach($request->membership_id as $key=>$m_id){
            $relese = new Release;
            $relese->membership_id =  $m_id;
            $relese->release_date = $request->release_date[$key];  
            $relese->action_id = $part->id;
            $relese->type = 'part';
            $relese->save();
        }
        return redirect()->route('admin.part')->with('success','Part Added Successfully..');

    }

    public function edit_part(Request $request, $id)
    {
       
        $id = $request->id;
        $update = Part::find($id);
        $update->name= $request->name;
        $update->part_length= $request->part_length;
        $update->phase_id = $request->phase_id;
       
        
        if($update->save())
        {
        foreach($request->membership_id as $key=>$m_id){
            
            $r = DB::table('releases')->where('type','part')->where('action_id',$id)->where('membership_id',$m_id)->get()->first();
            
            if($r) {
                DB::table('releases')->where('type','part')->where('action_id',$id)->where('membership_id',$m_id)
                ->update(['release_date' => $request->release_date[$key]]);
            } else {
                $relese = new Release;
                $relese->membership_id =  $m_id;
                $relese->release_date = $request->release_date[$key];  
                $relese->action_id = $id;
                $relese->type = 'part';
                $relese->save();
            }
        }
         return redirect()->route('admin.part')->with('success', 'Part Updated successfully.');
        }
        
    }

    public function Part_delete($id)
    {
        $datadel = Part::find($id);
        $datadel->delete();
        return redirect()->route('admin.part')
                      ->with('success','Part Delete successfully');
    }

    // Part  End //

// --------------------------------------------------------------------------------------------------------------------------

    // Memberships Start //

    public function Add_Membership(Request $request)
    {
        $validatedData = $request->validate(
        [
          'membership_type' => 'required',
        ]);
        $membership = new Membership;
        $membership->membership_type = $request->membership_type;
        $membership->save();
        return redirect()->route('admin.membership')->with('success','Membership Added Successfully..');
    }     

    public function edit_membership(Request $request, $id)
    {
        $id = $request->id;
        $update = Membership::find($id);
        $update->membership_type= $request->membership_type;
       
        if($update->save())
        {
            return redirect()->route('admin.membership')->with('success', 'Membership Updated Successfully.');
        }
    }

    public function Membership_delete($id)
    {
       $datadel = Membership::find($id);
       $datadel->delete();
       return redirect()->route('admin.membership')
                     ->with('success','Membership delete Successfully.');
    }

    //    LESSON // 
   
   public function Add_Lesson(Request $request)
   {
        $validatedData = $request->validate(
        [
          
          'lesson_name' => 'required',
          'lesson_type' => 'required',
          'phase_id' => 'required|integer',
          'part_id' => 'required|integer', 
        ],
        [
          'lesson_type'   => 'Please Select Lesson Type',
          'phase_id' => 'Please Select Phase',
          'part_id' => 'Please Select Part', 
        ]);
        $pre_slug = '';
        $count_lessson = Lesson::where("slug",'like', Str::slug($request->lesson_name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $file = $request->file('pdf');
        $pdf ='';
    	if($file){
			$fileName = 'pdf-'.time().'.'.$file->getClientOriginalExtension();
			$path = $file->storeAs('pdf', $fileName);
			$pdf= url('/storage/'.$path);
		}
        $lesson = new  Lesson;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->structured_transcript = $request->structured_transcript;
        $lesson->key_points = $request->key_points;
        $lesson->pdf = $pdf;
        $lesson->lesson_type = $request->lesson_type;
        $lesson->sub_lesson = $request->sub_lesson;
        $lesson->phase_id = $request->phase_id;
        $lesson->video_length= $request->video_length;
        $lesson->part_id = $request->part_id;
      //  $lesson->membership_id = $request->membership_id;
        $lesson->wistia_video_id = $request->wistia_video_id;
        $lesson->quiz_id = $request->quiz_id;
        $lesson->slug = Str::slug($request->lesson_name).$pre_slug;
        $lesson->save();

        foreach($request->membership_id as $key=>$m_id){
            $relese = new Release;
            $relese->membership_id =  $m_id;
            $relese->release_date = $request->release_date[$key];  
            $relese->action_id = $lesson->id;
            $relese->type = 'lesson';
            $relese->save();
        }
        return redirect()->route('admin.lesson')->with('success','Lesson Added Successfully..');
    }   
   
    public function edit_lesson(Request $request, $id)
    {
       $id = $request->id; 
       $update = Lesson::find($id);
       $update->lesson_name= $request->lesson_name;
       $update->lesson_type= $request->lesson_type;
       $update->phase_id= $request->phase_id;
       $update->part_id= $request->part_id;
       $update->video_length= $request->video_length;
      // $update->membership_id= $request->membership_id;
        $update->structured_transcript = $request->structured_transcript;
        $update->key_points = $request->key_points;
        if($request->wistia_video_id){
          $update->wistia_video_id = $request->wistia_video_id;
        }
        if($request->sub_lesson){
          
        }
        $update->sub_lesson = $request->sub_lesson;
        if($request->quiz_id){
          $update->quiz_id = $request->quiz_id;
        }
      
        $file = $request->file('pdf');
        $pdf ='';
    	if($file){
			$fileName = 'pdf-'.time().'.'.$file->getClientOriginalExtension();
			$path = $file->storeAs('pdf', $fileName, 'public');
			$pdf= url('/storage/'.$path);
             $update->pdf = $pdf;
		};
        if($update->save())
        {
        foreach($request->membership_id as $key=>$m_id){
            
            $r = DB::table('releases')->where('type','lesson')->where('action_id',$id)->where('membership_id',$m_id)->get()->first();
            
            if($r) {
                DB::table('releases')->where('type','lesson')->where('action_id',$id)->where('membership_id',$m_id)
                ->update(['release_date' => $request->release_date[$key]]);
            } else {
                $relese = new Release;
                $relese->membership_id =  $m_id;
                $relese->release_date = $request->release_date[$key];  
                $relese->action_id = $id;
                $relese->type = 'lesson';
                $relese->save();
            }
        }
        return redirect()->route('admin.lesson')->with('success', 'Lesson Updated Successfully.');
       }
    }
    
    public function lesson_delete($id)
    {
        $datadel = Lesson::find($id);
        $datadel->delete();
        return redirect()->route('admin.lesson')
                     ->with('success','Lesson Delete Successfully');
    }

    //    QUIZ //

    public function Add_Quiz(Request $request)
    {
        $validatedData = $request->validate(
        [
          'quiz_name' => 'required',
        ]);
        $pre_slug = '';
        $count_lessson = Quiz::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $quiz = new Quiz;
        $quiz->quiz_name = $request->quiz_name;
      
        $quiz->slug = Str::slug($request->quiz_name).$pre_slug;
        $quiz->save();
        return redirect()->route('admin.quiz')->with('success','Quiz Added Successfully..');
    }

    public function Add_Question(Request $request)
    {
       
        $id = $request->id;
        $qu = $request->quiz_id;

        $validatedData = $request->validate(
        [
          'question' => 'required',
          'question_type' => 'required',
        ]);
        
        $pre_slug = '';
        $count_lessson = Question::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $quiz = new Question;
        $quiz->question = $request->question;
        
        $quiz->more_information = $request->more_information;
        $quiz->question_type = $request->question_type;
        $quiz->quiz_id = $request->quiz_id;
        $quiz->answer = json_encode($request->answer);
        $quiz->correct_answer = isset($request->correct_answer) ? json_encode($request->correct_answer) : '';
        $quiz->slug = Str::slug($request->question).$pre_slug;

        $quiz->save();
        return redirect()->to('/admin/question/'.$qu.'/0')->with('success','Question Added Successfully..');
    }

    public function edit_quiz(Request $request, $id)
    {
        $id = $request->id;
        $update = Quiz::find($id);
        $update->quiz_name= $request->quiz_name;
       
        if($update->save())
        {
         return redirect()->route('admin.quiz')->with('success', 'Quiz Updated Successfully.');
        }
        
    }
    
    public function edit_Question(Request $request, $id, $quiz_id)
    {
       
       // $id = $request->quiz_id;
        $update = Question::find($quiz_id);
        $update->question= $request->question;
        $update->question_type= $request->question_type;
        $update->more_information = $request->more_information;
        $update->answer=  json_encode($request->answer);
       
        if($update->save())
        {
            //  return redirect()->route('admin.question','/'.$id.'/0')->with('success', 'Question Updated Successfully.');
            return redirect()->to('/admin/question/'.$id.'/0')->with('success', 'Question Updated Successfully.');
        }
    }
    
    public function Quiz_delete($id)
    {
        $datadel = Quiz::find($id);
        $datadel->delete();
        return redirect()->route('admin.quiz')
                      ->with('success','Quiz Delete Successfully');
    }
   
    public function question_delete($id, $quiz_id)
    {
        $datadel = Question::find($id);
        $datadel->delete();
        return redirect()->to('/admin/question/'.$quiz_id.'/0')
                      ->with('success','Question Delete Successfully');
    } 
    
    public function quiz_submission() 
    {
        return view('admin.quiz_submission');
    }
    
    public function quiz_submission_data()
    {
        $query = AnswerParent::leftjoin('users','answer_parents.user_id','=','users.id')
        ->leftjoin('lessons','answer_parents.lesson_id','=','lessons.id')
        ->leftjoin('quizzes','answer_parents.quiz_id','=','quizzes.id')
        ->select('answer_parents.id','users.name as user_name', 'quizzes.quiz_name','lessons.lesson_name','answer_parents.is_complete')
        ->get();

        return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $action = '<a href="'.route('admin.quiz_submission.detail', $row->id).'" Value="View Detail"><i class="uil uil-eye"></i></a>';
            return $action;
        })
        ->addColumn('user_name', function ($row) {
            return $row->user_name;
        })
        ->addColumn('quiz_name', function ($row) {
            return $row->quiz_name;
        })
        ->addColumn('lesson_name', function ($row) {
            return $row->lesson_name;
        })
        ->addColumn('is_complete', function ($row) {
            if($row->is_complete == 1) {
                return 'Completed';
            } else {
                return 'Not Complete';
            }
        })
        ->rawColumns(['action']) 
        ->make(true);
    }

    public function quiz_submission_detail($parent_id) 
    {
        $query = AnswerParent::leftjoin('users','answer_parents.user_id','=','users.id')
        ->leftjoin('lessons','answer_parents.lesson_id','=','lessons.id')
        ->leftjoin('quizzes','answer_parents.quiz_id','=','quizzes.id')
        ->select('users.name as user_name', 'quizzes.quiz_name','lessons.lesson_name')
        ->where('answer_parents.id',$parent_id)
        ->first();
        
        $user_name = $query->user_name;
        $quiz_name = $query->quiz_name;
        $lesson_name = $query->lesson_name;
        
        $data = Answer::leftjoin('questions','answers.question_id','=','questions.id')
        ->select('answers.*','questions.question', 'questions.question_type','questions.correct_answer')
        ->where('answers.parent_id',$parent_id)
        ->get();
        
        return view('admin.quiz_submission_detail',compact('data','user_name','quiz_name','lesson_name'));
    }
    
}
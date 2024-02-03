<?php

namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Phase;
use App\Models\Part;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Membership;
use App\Models\Answer;
use App\Models\AnswerParent;
use App\Models\UserVerify;
use Hash;
use Illuminate\Support\Str;
use Mail; 
use DB;
use Revolution\Google\Sheets\Facades\Sheets;

class AuthController extends Controller
{

    public function index()
    {
       
        if(Auth::check()){
              return redirect()->route('phase');
          }else{
              return view('user.login');
          }
       
    }  
    public function view()
    {
       
        return view('user.index');
    }  

    public function registration()
    {
        return view('user.register');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]); 
        if($user_id = User::where('email','=',$request->email)->where('is_deleted','0')->get('id')->first())
        {
            $token = Str::random(64);
            UserVerify::create([
              'user_id' => $user_id->id, 
              'token' => $token
            ]);
            
            $subject = "Email Verification";
            $message =  view('emails.emailVerificationEmail',compact('token'))->render();
            /* $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: The Social Edge <webmaster@example.com>' . "\r\n";
            
            mail($request->email,$subject,$message,$headers);
            */
            /* Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
            });
            */
            $ch = curl_init();
            $jayParsedAry = [
               "Messages" => [
                     [
                        "From" => [
                           "Email" => "info@training.nonverbalgroup.com", 
                           "Name" => "The Social Edge" 
                        ], 
                        "To" => [
                              [
                                 "Email" => $request->email, 
                                 "Name" => "" 
                              ] 
                           ], 
                        "Subject" => $subject,
                        "HTMLPart" => $message
                     ] 
                  ] 
            ]; 
             
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailjet.com/v3.1/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jayParsedAry));
            curl_setopt($ch, CURLOPT_USERPWD, "728a8817a6675911c37a50a68ba57ce8:2899ffc0fe6addf700276df8d6453396");
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch); 
            return redirect("check-your-inbox");
        }
        else{
           return redirect('login')->with('error','Email address is incorrect');
        }    
    }

    public function postRegistration(Request $request)
    {  

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        if(User::where('email','=',$request->email)->where('is_deleted','0')->first()) {
            
            return redirect("login")->with('error','Email already registered.');
        }
           
        $data = $request->all();
        $createUser = $this->create($data); 
        $token = Str::random(64);
    
        UserVerify::create([
          'user_id' => $createUser->id, 
          'token' => $token
        ]);
    
    /*    Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
        });
      */   
        return redirect("login")->with('success','Registration successful. Enter your email address to log in.');
    }
    
    public function dashboard()
    { 
            return view('dashboard');   
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        
      ]);
    }
      
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
            if($user){
                
                if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($verifyUser->created_at) + 60*60)) {
                    $message = 'Your verification link was expired please try again';
                    return redirect()->route('login')->with('error', $message);
                }
                
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                if (Auth::loginUsingId($user->id)) {
                    $message = "Your e-mail is verified. You can now login.";
                    return redirect()->route('phase')->with('message', $message);
                }else{
                    $message = 'Sorry, your email cannot be identified.';
                    return redirect()->route('login')->with('error', $message);
                }
            }else{
                $message = 'Sorry, your email cannot be identified.';
                return redirect()->route('login')->with('error', $message);
            }
        }
    }

    public function checkemail()
    {
        return view('check_email');
    }
    
    public function Phase_Detail($slug="")
    {
        if(Auth::check()){
            
            $membership_id = User::find(Auth::id())->membership_id;
            
            if($slug == ''){
                //$slug = Phase::get()->first()->slug;
                
                $ph = Phase::select('phases.*')
                    ->leftjoin('releases', 'phases.id', '=', 'releases.action_id')
                    ->where('releases.type','phase')
                    ->where('releases.membership_id',$membership_id)
                    ->where('phases.is_deleted','0')
                    ->where(function ($ph) {
                            $ph->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->orderBy('phases.order','ASC')
                    ->get()->first();
                    
                if($ph) {
                    $slug = $ph->slug;
                }
            }
        
             $phase_id = Phase::where('slug', $slug)->where('is_deleted','0')->get('id')->first();
             $id = isset($phase_id->id) ? $phase_id->id : 0;
    
            // $lesson = Lesson::where('phase_id',$id)->get();
            //$lesson = Lesson::all();
            
            $lesson = Lesson::select('lessons.*')
                    ->leftjoin('releases', 'lessons.id', '=', 'releases.action_id')
                    ->where('releases.type','lesson')
                    ->where('releases.membership_id',$membership_id)
                    ->where('lessons.is_deleted','0')
                    ->where(function ($lesson) {
                            $lesson->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->orderBy('lessons.order','ASC')
                    ->get();
    
            $phase_name = Phase::where('id',$id)->get();
            
            $phase = Phase::select('phases.*')
                    ->leftjoin('releases', 'phases.id', '=', 'releases.action_id')
                    ->where('releases.type','phase')
                    ->where('releases.membership_id',$membership_id)
                    ->where('phases.is_deleted','0')
                    ->where(function ($phase) {
                            $phase->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->orderBy('phases.order','ASC')
                    ->get();
                    
            $part = Part::select('parts.*')
                    ->leftjoin('releases', 'parts.id', '=', 'releases.action_id')
                    ->where('releases.type','part')
                    ->where('releases.membership_id',$membership_id)
                    ->where('parts.is_deleted','0')
                    ->where(function ($part) {
                            $part->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->where('parts.phase_id',$id)
                    ->orderBy('parts.order','ASC')
                    ->get();
            
            //$part = Part::where('phase_id',$id)->get();
            
            return view('user.phase',compact('phase','lesson','part','phase_name'));
        }
        
        return redirect("login")->with('error', 'Opps! You do not have access');
    }

    public function Deatil_quizes($slug)
    {
        $userId = Auth::id();
        $lesson = Lesson::select('lessons.*','phases.slug as phase_slug')->leftjoin('phases', 'lessons.phase_id', '=', 'phases.id')->where('lessons.slug', $slug)->where('lessons.is_deleted','0')->get()->first();
        $quiz_id = $lesson->quiz_id;
        $lesson_id = $lesson->id;
        
        $question = Question::where('quiz_id',$quiz_id)->where('is_deleted','0')->orderBy('order','ASC')->get();
        $answerParent = AnswerParent::where('lesson_id',$lesson_id)->where('quiz_id',$quiz_id)->where('user_id',$userId)->first();
       
        if($answerParent) {
            if($answerParent->is_complete == 1) {
                $answers = 'complete';
            } else {
                $answer = Answer::where('parent_id',$answerParent->id)->get();
                $answers = count($answer);
            }
        } else {
            $answers = 0;
        }
        $next_slug ='';
        $next = Lesson::where('sub_lesson',$lesson->sub_lesson)->where('part_id', $lesson->part_id)->where('phase_id',$lesson->phase_id)->where('lesson_type','assessment')->where('order','>',$lesson->order)->where('is_deleted','0')->orderBy('order','ASC')->get()->first();
        
        if($next) {
            $next_slug = $next->slug;
        }
        return view('user.quiz',compact('question','lesson','userId','answers','next_slug'));
    }

    public function Deatil_nested_conten($slug)
    {
        $lesson = Lesson::select('lessons.*','phases.slug as phase_slug')->leftjoin('phases', 'lessons.phase_id', '=', 'phases.id')->where('lessons.slug', $slug)->where('lessons.is_deleted','0')->get()->first();
        
        $prev_slug = '';
        $next_slug = '';
        
        $prev = Lesson::where('sub_lesson',$lesson->sub_lesson)->where('part_id', $lesson->part_id)->where('phase_id',$lesson->phase_id)->where('lesson_type','training')->where('order','<',$lesson->order)->where('is_deleted','0')->orderBy('order','DESC')->get()->first();
        
        if($prev) {
            $prev_slug = $prev->slug;
        }
        
        $next = Lesson::where('sub_lesson',$lesson->sub_lesson)->where('part_id', $lesson->part_id)->where('phase_id',$lesson->phase_id)->where('lesson_type','training')->where('order','>',$lesson->order)->where('is_deleted','0')->orderBy('order','ASC')->get()->first();
        
        if($next) {
            $next_slug = $next->slug;
        }
        
        return view('user.detail_nested-conten',compact('lesson','prev_slug','next_slug'));
    }

    public function Post_Answer(Request $request)
    {
        $userId = Auth::id();
        
        $lesson_id = $request->lesson_id;
        $quiz_id = $request->quiz_id;
        $parent_id = 0;
        $sheet_row = '';
    
        $quiz = Quiz::where('id', $quiz_id)->get()->first();
    
        $answerParent = AnswerParent::where('lesson_id',$lesson_id)->where('quiz_id',$quiz_id)->where('user_id',$userId)->first();
    
        if($answerParent) {
    
            $parent_id = $answerParent->id;
            $sheet_row = $answerParent->sheet_row;
    
        } else {
            
            $parent['user_id'] = $userId;
            $parent['lesson_id'] = $lesson_id;
            $parent['quiz_id'] = $quiz_id;
            $parent['sheet_row'] = 0;
            
            $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheetList();
        
            $sheet_name = isset($d[$quiz->sheet_id]) ? $d[$quiz->sheet_id] : '';
            
            if($sheet_name != '') {
                
                $date = date('m/d/Y');
                $user = User::where('id', $userId)->get()->first();
                
                $sheet_data = [
                    [$date, $user->email, $userId]
                ];
                $sheet_values = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheet($sheet_name)->append($sheet_data);
                
                $str = $sheet_values->updates->updatedRange;
        
                $arr = explode(":C", $str);
                
                $parent['sheet_row'] = end($arr);
            }
            
            $ansParent = AnswerParent::create($parent);
            $parent_id = $ansParent->id;
            $sheet_row = $ansParent->sheet_row;
        }
        
        $input['parent_id'] = $parent_id;
        $input['user_id'] = $userId;
        $input['quiz_id'] = $quiz_id;
        $input['question_id'] = $request->question_id;
        $input['sheet_cell_no'] = '';
        
        $sheet_answer = '';
        
        if($request->question_type == 'multiple') {
            
            $sheet_answer = implode(",",$request->answer);
            
            $input['answer'] = json_encode($request->answer);
            
        } else {
            
            $sheet_answer = $request->answer; 
            
            $input['answer'] = $request->answer;   
        }
    
        $question = Question::select('sheet_column')->where('id',$input['question_id'])->get()->first();
    
        if($question->sheet_column) {
            
            $input['sheet_cell_no'] = $question->sheet_column.$sheet_row;
            
            $quiz_data = [
                [$sheet_answer]
            ];
            
            $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheetList();
    
            $sheet_name = isset($d[$quiz->sheet_id]) ? $d[$quiz->sheet_id] : '';
            
            if($sheet_name != '') {
                $quiz_values =   Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->range($input['sheet_cell_no'])->sheet($sheet_name)->update($quiz_data);
            }
        }
    
        $admin = Answer::create($input);
        
        return response()->json(['status'=>true,'data'=>null, 'message'=>'Answer submitted successfully.']); 
    }
    
    public function update_video_time(Request $request)
    {
        
        $userId = Auth::id();
        $lesson_id = $request->lesson_id; 
        $input['w_time'] = (int)$request->time;
        $get_video_time = DB::table('video_time')->where('lesson_id',$lesson_id)->where('user_id',$userId)->first();
        if($get_video_time){
            $t = $get_video_time->w_time + $request->time;
            $input['w_time'] = (int)$t;
            DB::table('video_time')->where('lesson_id',$lesson_id)->where('user_id',$userId)->update($input);
        }else{
             $input['user_id'] = $userId;
             $input['lesson_id'] = $lesson_id; 
             DB::table('video_time')->insert($input);
        } 
        
        return response()->json(['status'=>true,'data'=>null, 'message'=>'Quiz submitted successfully.']); 
    }
    public function submit_quiz(Request $request)
    {
        
        $userId = Auth::id();
        $lesson_id = $request->lesson_id;
        $quiz_id = $request->quiz_id;
        
        $input['is_complete'] = '1';
        
        $answerParent = AnswerParent::where('lesson_id',$lesson_id)->where('quiz_id',$quiz_id)->where('user_id',$userId)->first();
        $answerParent->update($input);
        
        return response()->json(['status'=>true,'data'=>null, 'message'=>'Quiz submitted successfully.']); 
    }
   
}

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
         if($user_id = User::where('email','=',$request->email )->get('id')->first()){
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
            'email' => 'required|email|unique:users',
           
        ]);
           
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
                    ->where(function ($ph) {
                            $ph->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->get()->first();
                    
                if($ph) {
                    $slug = $ph->slug;
                }
            }
        
             $phase_id = Phase::where('slug', $slug)->get('id')->first();
             $id = isset($phase_id->id) ? $phase_id->id : 0;
    
            // $lesson = Lesson::where('phase_id',$id)->get();
            //$lesson = Lesson::all();
            
            $lesson = Lesson::select('lessons.*')
                    ->leftjoin('releases', 'lessons.id', '=', 'releases.action_id')
                    ->where('releases.type','lesson')
                    ->where('releases.membership_id',$membership_id)
                    ->where(function ($lesson) {
                            $lesson->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->get();
    
            $phase_name = Phase::where('id',$id)->get();
            
            $phase = Phase::select('phases.*')
                    ->leftjoin('releases', 'phases.id', '=', 'releases.action_id')
                    ->where('releases.type','phase')
                    ->where('releases.membership_id',$membership_id)
                    ->where(function ($phase) {
                            $phase->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->get();
                    
            $part = Part::select('parts.*')
                    ->leftjoin('releases', 'parts.id', '=', 'releases.action_id')
                    ->where('releases.type','part')
                    ->where('releases.membership_id',$membership_id)
                    ->where(function ($part) {
                            $part->where('releases.release_date','<=',date('Y-m-d H:i:s'))
                                ->orWhereNull('releases.release_date');
                        }
                    )
                    ->where('parts.phase_id',$id)
                    ->get();
            
            //$part = Part::where('phase_id',$id)->get();
            
            return view('user.phase',compact('phase','lesson','part','phase_name'));
        }
        
        return redirect("login")->with('error', 'Opps! You do not have access');
    }

    public function Deatil_quizes($slug)
    {
        $userId = Auth::id();
        $lesson = Lesson::select('lessons.*','phases.slug as phase_slug')->leftjoin('phases', 'lessons.phase_id', '=', 'phases.id')->where('lessons.slug', $slug)->get()->first();
        $quiz_id = $lesson->quiz_id;
        $lesson_id = $lesson->id;
        
        $question = Question::where('quiz_id',$quiz_id)->get();
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
        $next = Lesson::where('sub_lesson',$lesson->sub_lesson)->where('part_id', $lesson->part_id)->where('phase_id',$lesson->phase_id)->where('lesson_type','assessment')->where('id','>',$lesson->id)->orderBy('id','ASC')->get()->first();
        
        if($next) {
            $next_slug = $next->slug;
        }
        return view('user.quiz',compact('question','lesson','userId','answers','next_slug'));
    }

    public function Deatil_nested_conten($slug)
    {
        $lesson = Lesson::select('lessons.*','phases.slug as phase_slug')->leftjoin('phases', 'lessons.phase_id', '=', 'phases.id')->where('lessons.slug', $slug)->get()->first();
        
        $prev_slug = '';
        $next_slug = '';
        
        $prev = Lesson::where('sub_lesson',$lesson->sub_lesson)->where('part_id', $lesson->part_id)->where('phase_id',$lesson->phase_id)->where('lesson_type','training')->where('id','<',$lesson->id)->orderBy('id','DESC')->get()->first();
        
        if($prev) {
            $prev_slug = $prev->slug;
        }
        
        $next = Lesson::where('sub_lesson',$lesson->sub_lesson)->where('part_id', $lesson->part_id)->where('phase_id',$lesson->phase_id)->where('lesson_type','training')->where('id','>',$lesson->id)->orderBy('id','ASC')->get()->first();
        
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
    
        $answerParent = AnswerParent::where('lesson_id',$lesson_id)->where('quiz_id',$quiz_id)->where('user_id',$userId)->first();
    
        if($answerParent) {
    
            $parent_id = $answerParent->id;
    
        } else {
            
            $parent['user_id'] = $userId;
            $parent['lesson_id'] = $lesson_id;
            $parent['quiz_id'] = $quiz_id;
            
            $ansParent = AnswerParent::create($parent);
            $parent_id = $ansParent->id;
        }
        
        $input['parent_id'] = $parent_id;
        $input['user_id'] = $userId;
        $input['quiz_id'] = $quiz_id;
        $input['question_id'] = $request->question_id;
        
        if($request->question_type == 'multiple') {
            
            $input['answer'] = json_encode($request->answer);
            
        } else {
            $input['answer'] = $request->answer;   
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

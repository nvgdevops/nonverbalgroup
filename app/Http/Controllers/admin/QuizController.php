<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Part;
use App\Models\Answer;
use App\Models\AnswerParent;
use App\Imports\ImportQuiz;
use App\Imports\ImportQuestion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Exports\QuizCsvExport;
use App\Exports\QuestionCsvExport;

class QuizController extends Controller
{
    
    /* ----- Quiz ----- */
    
    public function quiz(Request $request,$quiz_id="",$id="")
    {
        $quiz_edit = [];
        if($request->ajax()){
            
            $query = Quiz::where('is_deleted','0')->get();
            
            return datatables()->of($query)
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

        $part = Part::where('is_deleted','0')->get();
        return view('admin.quiz',compact('quiz_edit','part'));
    }
    
    public function add_quiz(Request $request)
    {
        $validatedData = $request->validate(
        [
          'quiz_name' => 'required',
        ]);
        
        $query = Quiz::where("quiz_name",$request->quiz_name)->where('is_deleted','0')->get()->first();

        if($query) {
            return redirect()->route('admin.quiz')->with('error','Quiz Already Exists.');
        }
        
        $pre_slug = '';
        $count_lessson = Quiz::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $quiz = new Quiz;
        $quiz->quiz_name = $request->quiz_name;
      
        $quiz->slug = Str::slug($request->quiz_name).$pre_slug;
        $quiz->save();
        
        $data = [
            [$quiz->id, $quiz->quiz_name, '']
        ];
        $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Quiz')->append($data);
        
        if(isset($values->updates->updatedRange)) {
            $quiz_update = Quiz::find($quiz->id);  
            $quiz_update->sheet_range = $values->updates->updatedRange;
            
            $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->addSheet($quiz->quiz_name);
        
            if($d) {
                $quiz_update->sheet_id = $d->replies[0]->addSheet->properties->sheetId;
                
                $sheet_data = [
                    ['Date', 'User Email', 'User ID']
                ];
                $sheet_values = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheet($quiz->quiz_name)->append($sheet_data);
            }
        
            $quiz_update->save();
        }

        return redirect()->route('admin.quiz')->with('success','Quiz Added Successfully..');
    }
    
    public function edit_quiz(Request $request, $id)
    {
        $validatedData = $request->validate(
        [
          'quiz_name' => 'required',
        ]);
        
        $id = $request->id;
        
        $query = Quiz::where("quiz_name",$request->quiz_name)->where('id','!=',$id)->where('is_deleted','0')->get()->first();

        if($query) {
            return redirect()->route('admin.quiz')->with('error','Quiz Already Exists.');
        }
    
        $update = Quiz::find($id);
        $update->quiz_name= $request->quiz_name;
       
        if($update->save())
        {
            if(isset($update->sheet_range)) {
            
                $data = [
                    [$id, $update->quiz_name, '']
                ];
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($update->sheet_range)->sheet('Quiz')->update($data);
            }
            
            return redirect()->route('admin.quiz')->with('success', 'Quiz Updated Successfully.');
        }
    }
    
    public function quiz_delete($id)
    {
        $datadel = Quiz::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        
        if(isset($datadel->sheet_range)) {
        
            $data = [
                [$id, $datadel->quiz_name, 'Deleted']
            ];
            $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($datadel->sheet_range)->sheet('Quiz')->update($data);
        }
        
        if(isset($datadel->sheet_id)) {
            
            $sheet_name = $this->get_sheet_name_by_id($datadel->sheet_id);
            
            if($sheet_name != '') {
                $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->deleteSheet($sheet_name);
            }
        }
        
        return redirect()->route('admin.quiz')
                      ->with('success','Quiz Delete Successfully');
    }
    
    public function import_quiz(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ImportQuiz, request()->file('import_file'));
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->route('admin.quiz')->with('error', $errors);
        }
        return redirect()->route('admin.quiz')
            ->with('success', 'Quiz imported successfully');
    }
    
    function export_quiz()
    {
        $name = 'quiz-'.date('d-m-Y').'.csv';
        return (new QuizCsvExport)->download($name);
    }
    
    /* ----- Question ----- */
    
    public function question(Request $request,$quiz_id="", $id='')
    {
        $question_edit = [];
        if($request->ajax()){

            $query = Question::join('quizzes','questions.quiz_id','=','quizzes.id')
            ->select('questions.question','questions.order','questions.question_type', 'quizzes.quiz_name','questions.id','quizzes.id as qid','questions.id as questions_id')
            ->where('questions.quiz_id','=', $quiz_id)
            ->where('questions.is_deleted','0')
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
    
    public function add_question(Request $request)
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
        
        $quiz->more_information = isset($request->more_information) ? $request->more_information : '';
        $quiz->question_type = $request->question_type;
        $quiz->quiz_id = isset($request->quiz_id) ? $request->quiz_id : 0;
        $quiz->answer = isset($request->answer) ? json_encode($request->answer) : '';
        $quiz->order = isset($request->order) ? $request->order : 0;
        $quiz->correct_answer = isset($request->correct_answer) ? json_encode($request->correct_answer) : '';
        $quiz->slug = Str::slug($request->question).$pre_slug;

        $quiz->save();
        
        $optionA = $optionB = $optionC = $optionD = $optionE = $optionF = $optionG = $optionH = $optionI = $optionJ = '';
            
        if(!empty($quiz->answer) && $quiz->answer != 'null') {
            $ans = json_decode($quiz->answer, true);
            
            $i = 'A';
            
            foreach($ans as $ans_data) {
                
                $j = 'option'.$i;
                
                $$j = $ans_data;
                $i++;
            }
        }
        
        $q_name = Quiz::select('quiz_name','sheet_id')->where('id',$quiz->quiz_id)->get()->first();

        $quiz_name = '';

        if($q_name) {
            $quiz_name = $q_name->quiz_name;
        }
        
        $data = [
            [$quiz->id, $quiz->question, $quiz_name, $quiz->order, $quiz->more_information, $quiz->question_type, $optionA, $optionB, $optionC, $optionD, $optionE, $optionF, $optionG, $optionH, $optionI, $optionJ, '']
        ];
        $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Questions')->append($data);
        
        if(isset($values->updates->updatedRange)) {
            $question_update = Question::find($quiz->id);  
            $question_update->sheet_range = $values->updates->updatedRange;
            
            $max_sheet_column = Question::select('sheet_column')->where('quiz_id',$quiz->quiz_id)->orderBy('sheet_column','DESC')->get()->first();
            
            $col = 'D';
            
            if($max_sheet_column->sheet_column != null && !empty($max_sheet_column->sheet_column)) {
                $max_sheet_column->sheet_column++;
                $col = $max_sheet_column->sheet_column;
            }
         
            $quiz_data = [
                [$quiz->question]
            ];
            
            $sheet_name = $this->get_sheet_name_by_id($q_name->sheet_id);
            
            if($sheet_name != '') {
                $quiz_values =   Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->range($col.'1')->sheet($sheet_name)->update($quiz_data);
                $question_update->sheet_column = $col;
            }
            
            $question_update->save();
        }
        
        return redirect()->to('/admin/question/'.$qu.'/0')->with('success','Question Added Successfully..');
    }

    public function edit_question(Request $request, $id, $quiz_id)
    {
       
       // $id = $request->quiz_id;
        $update = Question::find($quiz_id);
        $update->question= $request->question;
        $update->question_type= $request->question_type;
        $update->more_information = isset($request->more_information) ? $request->more_information : '';
        $update->answer=  json_encode($request->answer);
        $update->order = isset($request->order) ? $request->order : 0;
        
        if($update->save())
        {
            if(isset($update->sheet_range)) {
            
                $optionA = $optionB = $optionC = $optionD = $optionE = $optionF = $optionG = $optionH = $optionI = $optionJ = '';
                
                if(!empty($update->answer) && $update->answer != 'null') {
                    $ans = json_decode($update->answer, true);
                    
                    $i = 'A';
                    
                    foreach($ans as $ans_data) {
                        
                        $j = 'option'.$i;
                        
                        $$j = $ans_data;
                        $i++;
                    }
                }
                
                $q_name = Quiz::select('quiz_name')->where('id',$update->quiz_id)->get()->first();
        
                $quiz_name = '';
        
                if($q_name) {
                    $quiz_name = $q_name->quiz_name;
                }
                
                $data = [
                    [$update->id, $update->question, $quiz_name, $update->order, $update->more_information, $update->question_type, $optionA, $optionB, $optionC, $optionD, $optionE, $optionF, $optionG, $optionH, $optionI, $optionJ, '']
                ];
                
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($update->sheet_range)->sheet('Questions')->update($data);
            
            }
            
            if(isset($update->sheet_column)) {
            
                $sheet_name = $this->get_sheet_name_by_id($update->sheet_id);
            
                if($sheet_name != '') {
                    $quiz_data = [
                        [$update->question]
                    ];
                    
                    $quiz_values =   Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->range($update->sheet_column.'1')->sheet($q_name->quiz_name)->update($quiz_data);
                }
            }
            
            return redirect()->to('/admin/question/'.$id.'/0')->with('success', 'Question Updated Successfully.');
        }
    }
    
    public function question_delete($id, $quiz_id)
    {
        $datadel = Question::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        
        if(isset($datadel->sheet_range)) {
            
            $optionA = $optionB = $optionC = $optionD = $optionE = $optionF = $optionG = $optionH = $optionI = $optionJ = '';
            
            if(!empty($datadel->answer) && $datadel->answer != 'null') {
                $ans = json_decode($datadel->answer, true);
                
                $i = 'A';
                
                foreach($ans as $ans_data) {
                    
                    $j = 'option'.$i;
                    
                    $$j = $ans_data;
                    $i++;
                }
            }
            
            $q_name = Quiz::select('quiz_name')->where('id',$datadel->quiz_id)->get()->first();
    
            $quiz_name = '';
    
            if($q_name) {
                $quiz_name = $q_name->quiz_name;
            }
            
            $data = [
                [$datadel->id, $datadel->question, $quiz_name, $datadel->order, $datadel->more_information, $datadel->question_type, $optionA, $optionB, $optionC, $optionD, $optionE, $optionF, $optionG, $optionH, $optionI, $optionJ, 'Deleted']
            ];
            $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($datadel->sheet_range)->sheet('Questions')->update($data);
        
        }
        
        return redirect()->to('/admin/question/'.$quiz_id.'/0')
                      ->with('success','Question Delete Successfully');
    } 
    
    public function import_question(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ImportQuestion, request()->file('import_file'));
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->route('admin.quiz')->with('error', $errors);
        }
        return redirect()->route('admin.quiz')
            ->with('success', 'Question imported successfully');
    }
    
    function export_question()
    {
        $name = 'question-'.date('d-m-Y').'.csv';
        return (new QuestionCsvExport)->download($name);
    }
    
    /* ----- Quiz Submission ----- */
    
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
    
    public function get_sheet_name_by_id($sheet_id) {
        
        $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheetList();
        
        return isset($d[$sheet_id]) ? $d[$sheet_id] : '';
    }
    
}
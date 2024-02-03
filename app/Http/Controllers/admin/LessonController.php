<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Lesson;
use App\Models\Phase;
use App\Models\Part;
use App\Models\Membership;
use App\Models\Release;
use App\Models\Quiz;
use App\Imports\ImportLesson;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Exports\LessonCsvExport;

class LessonController extends Controller
{
    
    public function lesson(Request $request,$id="")
    {
        $lesson_edit = [];
        if($request->ajax()){

            $query = Lesson::leftJoin('phases','lessons.phase_id','=','phases.id')
                  ->leftJoin('parts','lessons.part_id','=','parts.id')
                  ->leftJoin('quizzes','lessons.quiz_id','=','quizzes.id')
                  ->select('lessons.lesson_name', 'lessons.order', 'phases.name','lessons.lesson_type','lessons.id','parts.name as pname','quizzes.quiz_name','lessons.wistia_video_id')->where('lessons.is_deleted','0')->get();
                 
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
              return  Str::limit($row->quiz_name, 20,"...").Str::limit($row->wistia_video_id, 20,"...") ;
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

        $part = Part::where('is_deleted','0')->get();
        $phase =Phase::where('is_deleted','0')->get();
        $membership = Membership::where('is_deleted','0')->get();
        $quiz = Quiz::where('is_deleted','0')->get();
        $lesson = Lesson::where('is_deleted','0')->get();

        if($id != ''){
            $lesson_edit = Lesson::find($id);
         /*   $membership = DB::table('memberships')
          ->select('memberships.*','releases.release_date')
          ->join('releases','releases.membership_id', '=', 'memberships.id')->where('releases.action_id','=',  $lesson_edit->id)->where('type','=','lesson')->get();
       */
       
       $membership = Membership::select('memberships.*',DB::raw("(SELECT release_date FROM releases WHERE releases.membership_id = memberships.id AND releases.action_id = $lesson_edit->id AND type = 'lesson' ORDER BY releases.id DESC LIMIT 1) as release_date"))->where('memberships.is_deleted','0')->get();
       
       //   dd($membership);
          
        } 
        else{
            $membership = Membership::where('is_deleted','0')->get();
        }
        return view('admin.lesson',compact('part','phase','membership','lesson_edit','quiz','lesson','membership'));
    }
    
    public function add_lesson(Request $request)
    {
        $validatedData = $request->validate(
        [
          'lesson_name' => 'required',
          'lesson_type' => 'required',
          'phase_id' => 'required|integer',
          'part_id' => 'required|integer'
        ],
        [
          'lesson_type'   => 'Please Select Lesson Type',
          'phase_id' => 'Please Select Phase',
          'part_id' => 'Please Select Part'
        ]);
        
        $pre_slug = '';
        $count_lessson = Lesson::where("slug",'like', Str::slug($request->lesson_name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        
        $lesson = new  Lesson;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->structured_transcript = isset($request->structured_transcript) ? $request->structured_transcript : '';
        $lesson->key_points = isset($request->key_points) ? $request->key_points : '';
        //$lesson->pdf = $pdf;
        $lesson->lesson_type = $request->lesson_type;
        $lesson->sub_lesson = isset($request->sub_lesson) ? $request->sub_lesson : 0;
        $lesson->phase_id = $request->phase_id;
        $lesson->video_length= isset($request->video_length) ? $request->video_length : '';
        $lesson->part_id = $request->part_id;
        $lesson->wistia_video_id = isset($request->wistia_video_id) ? $request->wistia_video_id : '';
        $lesson->quiz_id = isset($request->quiz_id) ? $request->quiz_id : 0;
        $lesson->order = isset($request->order) ? $request->order : 0;
        $lesson->slug = Str::slug($request->lesson_name).$pre_slug;
        $file = $request->file('pdf');
        $pdf ='';
        
    	if($file){
			$fileName = 'pdf-'.time().'.'.$file->getClientOriginalExtension();
			$path = $file->storeAs('pdf', $fileName, 'public');
			$pdf= url('/storage/'.$path);
            $lesson->pdf = $pdf;
		};
        $lesson->save();
        
        $lessons = Lesson::leftJoin('phases','lessons.phase_id','=','phases.id')
                  ->leftJoin('parts','lessons.part_id','=','parts.id')
                  ->leftJoin('quizzes','lessons.quiz_id','=','quizzes.id')
                  ->leftJoin('lessons as subLesson','lessons.sub_lesson','=','subLesson.id')
                  ->select('subLesson.lesson_name as sub_lesson_name', 'phases.name', 'parts.name as pname', 'quizzes.quiz_name')->where('lessons.id',$lesson->id)->get()->first();
        
        $phase_name = isset($lessons->name) ? $lessons->name : '';
        $part_name = isset($lessons->pname) ? $lessons->pname : '';
        $quiz_name = isset($lessons->quiz_name) ? $lessons->quiz_name : '';
        $parent_lesson_name = isset($lessons->sub_lesson_name) ? $lessons->sub_lesson_name : '';
        
        $data = [
            [$lesson->id, $lesson->lesson_name, $parent_lesson_name, $lesson->lesson_type, $phase_name, $part_name, $lesson->order, $quiz_name, $lesson->wistia_video_id, $lesson->video_length, $lesson->structured_transcript, $lesson->key_points, '']
        ];
        $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Lessons')->append($data);

        if(isset($values->updates->updatedRange)) {
            $lesson_update = Lesson::find($lesson->id);  
            $lesson_update->sheet_range = $values->updates->updatedRange;
            $lesson_update->save();
        }

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
        $validatedData = $request->validate(
        [
          'lesson_name' => 'required',
          'lesson_type' => 'required',
          'phase_id' => 'required|integer',
          'part_id' => 'required|integer'
        ],
        [
          'lesson_type'   => 'Please Select Lesson Type',
          'phase_id' => 'Please Select Phase',
          'part_id' => 'Please Select Part'
        ]);
        
        $id = $request->id; 
        $update = Lesson::find($id);
        $update->lesson_name= $request->lesson_name;
        $update->lesson_type= $request->lesson_type;
        $update->phase_id= $request->phase_id;
        $update->part_id= $request->part_id;
        $update->video_length= isset($request->video_length) ? $request->video_length : '';
        $update->order = isset($request->order) ? $request->order : 0;
        $update->structured_transcript = isset($request->structured_transcript) ? $request->structured_transcript : '';
        $update->key_points = isset($request->key_points) ? $request->key_points : '';
        if($request->wistia_video_id){
          
        }
        $update->wistia_video_id = $request->wistia_video_id;
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
            if(isset($update->sheet_range)) {
                
                $lessons = Lesson::leftJoin('phases','lessons.phase_id','=','phases.id')
                  ->leftJoin('parts','lessons.part_id','=','parts.id')
                  ->leftJoin('quizzes','lessons.quiz_id','=','quizzes.id')
                  ->leftJoin('lessons as subLesson','lessons.sub_lesson','=','subLesson.id')
                  ->select('subLesson.lesson_name as sub_lesson_name', 'phases.name', 'parts.name as pname', 'quizzes.quiz_name')->where('lessons.id',$id)->get()->first();
        
                $phase_name = isset($lessons->name) ? $lessons->name : '';
                $part_name = isset($lessons->pname) ? $lessons->pname : '';
                $quiz_name = isset($lessons->quiz_name) ? $lessons->quiz_name : '';
                $parent_lesson_name = isset($lessons->sub_lesson_name) ? $lessons->sub_lesson_name : '';
                
                $data = [
                    [$update->id, $update->lesson_name, $parent_lesson_name, $update->lesson_type, $phase_name, $part_name, $update->order, $quiz_name, $update->wistia_video_id, $update->video_length, $update->structured_transcript, $update->key_points, '']
                ];
                
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($update->sheet_range)->sheet('Lessons')->update($data);
            }
            
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
        $datadel->is_deleted = 1;
        $datadel->save();
        
        if(isset($datadel->sheet_range)) {
                
            $lessons = Lesson::leftJoin('phases','lessons.phase_id','=','phases.id')
              ->leftJoin('parts','lessons.part_id','=','parts.id')
              ->leftJoin('quizzes','lessons.quiz_id','=','quizzes.id')
              ->leftJoin('lessons as subLesson','lessons.sub_lesson','=','subLesson.id')
              ->select('subLesson.lesson_name as sub_lesson_name', 'phases.name', 'parts.name as pname', 'quizzes.quiz_name')->where('lessons.id',$id)->get()->first();
    
            $phase_name = isset($lessons->name) ? $lessons->name : '';
            $part_name = isset($lessons->pname) ? $lessons->pname : '';
            $quiz_name = isset($lessons->quiz_name) ? $lessons->quiz_name : '';
            $parent_lesson_name = isset($lessons->sub_lesson_name) ? $lessons->sub_lesson_name : '';
            
            $data = [
                [$datadel->id, $datadel->lesson_name, $parent_lesson_name, $datadel->lesson_type, $phase_name, $part_name, $datadel->order, $quiz_name, $datadel->wistia_video_id, $datadel->video_length, $datadel->structured_transcript, $datadel->key_points, 'Deleted']
            ];
            
            $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($datadel->sheet_range)->sheet('Lessons')->update($data);
        }
        
        return redirect()->route('admin.lesson')
                     ->with('success','Lesson Delete Successfully');
    }
    
    public function import_lesson(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ImportLesson, request()->file('import_file'));
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->route('admin.lesson')->with('error', $errors);
        }
        return redirect()->route('admin.lesson')
            ->with('success', 'Lesson imported successfully');
    }
    
    function export_lesson()
    {
        $name = 'lesson-'.date('d-m-Y').'.csv';
        return (new LessonCsvExport)->download($name);
    }
}
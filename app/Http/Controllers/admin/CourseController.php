<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Course;
use App\Imports\ImportCourse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Exports\CourseCsvExport;

class CourseController extends Controller
{
    
    public function course(Request $request,$id="")
    {
        $course_edit = [];
        if($request->ajax()){
            
            $query = Course::where('is_deleted','0')->get();
            
            return datatables()->of($query)
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
        
        $data = [
            [$course->id, $course->name, '']
        ];
        $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Courses')->append($data);
    
        if(isset($values->updates->updatedRange)) {
            $course_update = Course::find($course->id);  
            $course_update->sheet_range = $values->updates->updatedRange;
            $course_update->save();
        }
      
        return redirect()->route('admin.course')->with('success','Course Added SuccessFully...');
    }

    public function edit_course(Request $request, $id)
    {
        $id = $request->id;
        $update = Course::find($id);
        $update->name= $request->name;

        if($update->save())
        {
            if(isset($update->sheet_range)) {
                $data = [
                    [$id, $update->name, '']
                ];
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($update->sheet_range)->sheet('Courses')->update($data);
            }
            
         return redirect()->route('admin.course')->with('success', 'Course Updated successfully.');
        }
    }
    
    public function course_detail($id, $slug = '')
    {
        $course = Course::find($id);
        $phase = Phase::where('course_id',$id)->where('is_deleted','0')->first();
        
        if($slug == ''){
            
            $ph = Phase::where('course_id',$id)->where('is_deleted','0')->get()->first();
                
            if($ph) {
                $slug = $ph->slug;
            }
        }
        
        $phase_id = Phase::where('slug', $slug)->where('is_deleted','0')->get('id')->first();
        $ph_id = isset($phase_id->id) ? $phase_id->id : 0;

        $lesson = Lesson::where('is_deleted','0')->get();
        $phase = Phase::where('is_deleted','0')->get();
        $part = Part::where('phase_id',$ph_id)->where('is_deleted','0')->get();
        
        return view('admin.course_detail',compact('course','phase','lesson','part','ph_id'));
    }
    
    public function course_delete($id)
    {
        $datadel = Course::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        
        if(isset($datadel->sheet_range)) {
        
            $data = [
                [$id, $datadel->name, 'Deleted']
            ];
            $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($datadel->sheet_range)->sheet('Courses')->update($data);
        }
        
        return redirect()->route('admin.course')
                      ->with('success','Course Deleted successfully');
    }
    
    public function import_course(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ImportCourse, request()->file('import_file'));
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->route('admin.course')->with('error', $errors);
        }
        return redirect()->route('admin.course')
            ->with('success', 'Course imported successfully');
    }
    
    function export_course()
    {
        $name = 'course-'.date('d-m-Y').'.csv';
        return (new CourseCsvExport)->download($name);
    }
}
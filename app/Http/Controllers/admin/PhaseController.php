<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Phase;
use App\Models\Course;
use App\Models\Membership;
use App\Models\Release;
use App\Imports\ImportPhase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Exports\PhaseCsvExport;
use Revolution\Google\Sheets\Facades\Sheets;

class PhaseController extends Controller
{
    
    public function phase(Request $request,$id="")
    {
        $phase_edit = [];
        
        if($request->ajax()){
            
            $query = Phase::leftjoin('courses','phases.course_id','=','courses.id')
                 ->select('courses.name as course_name', 'phases.*')->where('phases.is_deleted','0')->get();
            
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
            $membership = Membership::select('memberships.*',DB::raw("(SELECT release_date FROM releases WHERE releases.membership_id = memberships.id AND releases.action_id = $phase_edit->id AND type = 'phase' ORDER BY releases.id DESC LIMIT 1) as release_date"))->where('memberships.is_deleted','0')->get();
        } 
          else{
              $membership = Membership::where('is_deleted','0')->get();
          }
          
          $course = Course::where('is_deleted','0')->get();
        return view('admin.phase',compact('phase_edit','membership','course'));
    }
    
    
    public function add_phase(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);
        $phase = new Phase;
        $pre_slug = '';
        $count_lessson = Phase::where("slug",'like', Str::slug($request->name).'%')->get()->count();
        if($count_lessson > 0){ 
          $pre_slug = "-".$count_lessson;
        }
        $phase->name = $request->name;
        $phase->course_id = isset($request->course_id) ? $request->course_id : 0;
        $phase->phase_title = isset($request->phase_title) ? $request->phase_title : '';
        $phase->phase_length = isset($request->phase_length) ? $request->phase_length : '';
        $phase->phase_dec = isset($request->phase_dec) ? $request->phase_dec : '';
        $phase->order = isset($request->order) ? $request->order : 0;
        $phase->slug = Str::slug($request->name).$pre_slug;
        $phase->save();

        $course = Course::select('name')->where('id',$phase->course_id)->get()->first();

        $course_name = '';

        if($course) {
            $course_name = $course->name;
        }

        $data = [
            [$phase->id, $phase->name, $phase->phase_length, $phase->phase_title, $course_name, $phase->order, $phase->phase_dec, '']
        ];
        
        // Append multiple rows at once
        $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Phases')->append($data);
       
        if(isset($values->updates->updatedRange)) {
            $phase_update = Phase::find($phase->id);  
            $phase_update->sheet_range = $values->updates->updatedRange;
            $phase_update->save();
        }
        
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
        $update->phase_length = isset($request->phase_length) ? $request->phase_length : '';
        $update->phase_title = isset($request->phase_title) ? $request->phase_title : '';
        $update->phase_dec = isset($request->phase_dec) ? $request->phase_dec : '';
        $update->order = isset($request->order) ? $request->order : 0;

        if($update->save())
        {
            if(isset($update->sheet_range)) {
                
                $course = Course::select('name')->where('id',$update->course_id)->get()->first();
    
                $course_name = '';
        
                if($course) {
                    $course_name = $course->name;
                }
        
                $data = [
                    [$id, $update->name, $update->phase_length, $update->phase_title, $course_name, $update->order, $update->phase_dec, '']
                ];
                
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->range($update->sheet_range)->sheet('Phases')->update($data);
            }
            
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
    
    public function phase_delete($id)
    {
        $datadel = Phase::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        
        if(isset($datadel->sheet_range)) {
        
            $course = Course::select('name')->where('id',$datadel->course_id)->get()->first();
    
            $course_name = '';
    
            if($course) {
                $course_name = $course->name;
            }
    
            $data = [
                [$id, $datadel->name, $datadel->phase_length, $datadel->phase_title, $course_name, $datadel->order, $datadel->phase_dec, 'Deleted']
            ];
            
            $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->range($datadel->sheet_range)->sheet('Phases')->update($data);
        
        }
        
        return redirect()->route('admin.phase')
                      ->with('success','Phase Delete successfully');
    }
    
    public function import_phase(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ImportPhase, request()->file('import_file'));
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->route('admin.phase')->with('error', $errors);
        }
        return redirect()->route('admin.phase')
            ->with('success', 'Phase imported successfully');
    }
    
    function export_phase()
    {
        $name = 'phase-'.date('d-m-Y').'.csv';
        return (new PhaseCsvExport)->download($name);
    }
}
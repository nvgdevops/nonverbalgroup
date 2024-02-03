<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Phase;
use App\Models\Part;
use App\Models\Membership;
use App\Models\Release;
use App\Imports\ImportPart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Exports\PartCsvExport;

class PartController extends Controller
{
    
    public function part(Request $request,$id="")
       {
        $part_edit = [];

        if($request->ajax()){
            // $query = Part::join('phases','parts.phase_id', '=', 'phases.id')
            //      ->select('parts.id', 'parts.name', 'phases.name')
            //      ->get();

                 $query = Part::leftjoin('phases','parts.phase_id','=','phases.id')
                 ->select('parts.name as pname', 'parts.order', 'phases.name','parts.id')->where('parts.is_deleted','0')->get();

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

        $part = Phase::where('is_deleted','0')->get();
        
        if($id != ''){
            $part_edit = Part::find($id);
            /*$membership = DB::table('memberships')
          ->select('memberships.*','releases.release_date')
          ->join('releases','releases.membership_id', '=', 'memberships.id')->where('releases.action_id','=',  $part_edit->id)->where('type','=','part')->get(); */
          
          $membership = Membership::select('memberships.*',DB::raw("(SELECT release_date FROM releases WHERE releases.membership_id = memberships.id AND releases.action_id = $part_edit->id AND type = 'part' ORDER BY releases.id DESC LIMIT 1) as release_date"))->where('memberships.is_deleted','0')->get();
          
        } 
        else{
            $membership = Membership::where('is_deleted','0')->get();
        }
        return view('admin.part',compact('part','part_edit','membership'));
    }
    
    public function add_part(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'phase_id' => 'required|integer'
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
        $part->part_length= isset($request->part_length) ? $request->part_length : '';
        $part->phase_id = $request->phase_id;
        $part->slug = Str::slug($request->name).$pre_slug;
        $part->order = isset($request->order) ? $request->order : 0;
        $part->save();

        $phase = Phase::select('name')->where('id',$part->phase_id)->get()->first();

        $phase_name = '';

        if($phase) {
            $phase_name = $phase->name;
        }

        $data = [
            [$part->id, $part->name, $part->part_length, $phase_name, $part->order, '']
        ];
        $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Parts')->append($data);

        if(isset($values->updates->updatedRange)) {
            $part_update = Part::find($part->id);  
            $part_update->sheet_range = $values->updates->updatedRange;
            $part_update->save();
        }

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
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'phase_id' => 'required|integer'
            ],
            [
                'phase_id' => 'Please Select Phase' 
            ]
        );
        
        $id = $request->id;
        $update = Part::find($id);
        $update->name= $request->name;
        $update->part_length= isset($request->part_length) ? $request->part_length : '';
        $update->phase_id = isset($request->phase_id) ? $request->phase_id : 0;
        $update->order = isset($request->order) ? $request->order : 0;
        
        if($update->save())
        {
            if(isset($update->sheet_range)) {
            
                $phase = Phase::select('name')->where('id',$update->phase_id)->get()->first();
    
                $phase_name = '';
        
                if($phase) {
                    $phase_name = $phase->name;
                }
        
                $data = [
                    [$id, $update->name, $update->part_length, $phase_name, $update->order, '']
                ];
                
                $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->range($update->sheet_range)->sheet('Parts')->update($data);
            }
            
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

    public function part_delete($id)
    {
        $datadel = Part::find($id);
        $datadel->is_deleted = 1;
        $datadel->save();
        
        if(isset($datadel->sheet_range)) {
        
            $phase = Phase::select('name')->where('id',$datadel->phase_id)->get()->first();
    
            $phase_name = '';
    
            if($phase) {
                $phase_name = $phase->name;
            }
    
            $data = [
                [$id, $datadel->name, $datadel->part_length, $phase_name, $datadel->order, 'Deleted']
            ];
            
            $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->range($datadel->sheet_range)->sheet('Parts')->update($data);
        
        }
        
        return redirect()->route('admin.part')
                      ->with('success','Part Delete successfully');
    }
    
    public function import_part(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ImportPart, request()->file('import_file'));
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->route('admin.part')->with('error', $errors);
        }
        return redirect()->route('admin.part')
            ->with('success', 'Part imported successfully');
    }
    
    function export_part()
    {
        $name = 'part-'.date('d-m-Y').'.csv';
        return (new PartCsvExport)->download($name);
    }
}
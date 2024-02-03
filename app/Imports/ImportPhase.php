<?php

namespace App\Imports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel; 
use App\Models\Phase;
use App\Models\Course;
use Illuminate\Support\Str;
use Revolution\Google\Sheets\Facades\Sheets;
use DB;

class ImportPhase implements ToCollection, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function collection(Collection $rows)
    {
        $row_num=1;
        $error = array();
        foreach ($rows as $row) {
            
            $row_num++;
            $flag = 1;
            $input = new Phase();

            $input['name'] = is_null(@$row[0]) ? '' : @$row[0];

            $pre_slug = '';
            $count_lessson = Phase::where("slug",'like', Str::slug($input['name']).'%')->get()->count();
            if($count_lessson > 0){ 
              $pre_slug = "-".$count_lessson;
            }
            
            $input['slug'] = Str::slug($input['name']).$pre_slug;
        
            $input['phase_length'] = is_null(@$row[1]) ? '' : @$row[1];
            $input['phase_title'] = is_null(@$row[2]) ? '' : @$row[2];
            $course_name = is_null(@$row[3]) ? '' : @$row[3];
            
            $input['order'] = is_null(@$row[4]) ? 0 : @$row[4];
            
            if(!is_int($input['order'])) {
                $input['order'] = 0;
            }
            
            $input['phase_dec'] = is_null(@$row[5]) ? '' : @$row[5];

            $input['course_id'] = 0;

            if($course_name != '') {
                
                $course = Course::where('name',$course_name)->where('is_deleted','0')->get()->first();
            
                if($course) {
                    $input['course_id'] = $course->id;
                }
            }

            if($flag==1)
            {
                $input->save();
                
                $data = [
                    [$input->id, $input->name, $input->phase_length, $input->phase_title, $course_name, $input->order, $input->phase_dec, '']
                ];
                
                // Append multiple rows at once
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Phases')->append($data);
                
                if(isset($values->updates->updatedRange)) {
                    $phase_update = Phase::find($input->id);  
                    $phase_update->sheet_range = $values->updates->updatedRange;
                    $phase_update->save();
                }
            }
        }
 
        if(count($error) > 0):
            throw ValidationException::withMessages(['error' => $error]);
        endif;
    }
    public function startRow(): int
    {
        return 2;
    }
}

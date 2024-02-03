<?php

namespace App\Imports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel; 
use Revolution\Google\Sheets\Facades\Sheets;
use App\Models\Phase;
use App\Models\Part;
use DB;

class ImportPart implements ToCollection, WithStartRow
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
            $input = new Part();

            $input['name'] = is_null(@$row[0]) ? '' : @$row[0];

            $pre_slug = '';
            $count_lessson = Part::where("slug",'like', Str::slug($input['name']).'%')->get()->count();
            if($count_lessson > 0){ 
                $pre_slug = "-".$count_lessson;
            }
            
            $input['slug'] = Str::slug($input['name']).$pre_slug;
            
            $input['part_length'] = is_null(@$row[1]) ? '' : @$row[1];
            $phase_name = is_null(@$row[2]) ? '' : @$row[2];
            $input['order'] = is_null(@$row[3]) ? 0 : @$row[3];
            
            if(!is_int($input['order'])) {
                $input['order'] = 0;
            }

            $input['phase_id'] = 0;

            if($phase_name != '') {
                
                $phase = Phase::where('name',$phase_name)->where('is_deleted','0')->get()->first();
            
                if($phase) {
                    $input['phase_id'] = $phase->id;
                }
            }

            if($flag==1)
            {
                $input->save();
                $data = [
                    [$input->id, $input->name, $input->part_length, $phase_name, $input->order, '']
                ];
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Parts')->append($data);
                
                if(isset($values->updates->updatedRange)) {
                    $part_update = Part::find($input->id);  
                    $part_update->sheet_range = $values->updates->updatedRange;
                    $part_update->save();
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

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
use App\Models\Quiz;
use DB;

class ImportQuiz implements ToCollection, WithStartRow
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
            $input = new Quiz();

            $input['quiz_name'] = is_null(@$row[0]) ? '' : @$row[0];
            $name = $input['quiz_name'];
            
            $query = Quiz::where("quiz_name",$name)->where('is_deleted','0')->get()->first();

            if($query) {
                continue;
            }

            $pre_slug = '';
            $count_quiz = Quiz::where("slug",'like', Str::slug($name).'%')->get()->count();
            if($count_quiz > 0){ 
              $pre_slug = "-".$count_quiz;
            }
            
            $input['slug'] = Str::slug($name).$pre_slug;

            if($flag==1)
            {
                $input->save();
                $data = [
                    [$input->id, $input->quiz_name, '']
                ];
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Quiz')->append($data);
                
                if(isset($values->updates->updatedRange)) {
                    $quiz_update = Quiz::find($input->id);  
                    $quiz_update->sheet_range = $values->updates->updatedRange;
                    
                    $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->addSheet($quiz_update->quiz_name);
        
                    if($d) {
                        $quiz_update->sheet_id = $d->replies[0]->addSheet->properties->sheetId; 
                        $sheet_data = [
                            ['Date', 'User Email', 'User ID']
                        ];
                        $qname = $quiz_update->quiz_name;
                        $sheet_values = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheet("$name")->append($sheet_data); 
                    }
                    
                    $quiz_update->save();
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

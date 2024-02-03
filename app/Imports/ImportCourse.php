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
use App\Models\Course;
use DB;

class ImportCourse implements ToCollection, WithStartRow
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
            $input = new Course();

            $input['name'] = is_null(@$row[0]) ? '' : @$row[0];
            $name = $input['name'];

            $pre_slug = '';
            $count_course = Course::where("slug",'like', Str::slug($name).'%')->get()->count();
            if($count_course > 0){ 
              $pre_slug = "-".$count_course;
            }
            
            $input['slug'] = Str::slug($name).$pre_slug;

            if($flag==1)
            {
                $input->save();
                $data = [
                    [$input->id, $input->name, '']
                ];
                $values = Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Courses')->append($data);
                
                if(isset($values->updates->updatedRange)) {
                    $course_update = Course::find($input->id);  
                    $course_update->sheet_range = $values->updates->updatedRange;
                    $course_update->save();
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

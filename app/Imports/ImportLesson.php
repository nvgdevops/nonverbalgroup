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
use App\Models\Lesson;
use App\Models\Phase;
use App\Models\Part;
use App\Models\Quiz;
use DB;

class ImportLesson implements ToCollection, WithStartRow
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
            $input = new Lesson();
            
            $lesson_name = is_null(@$row[0]) ? '' : @$row[0];
            $input['lesson_name'] = $lesson_name;
            
            $pre_slug = '';
            $count_lessson = Lesson::where("slug",'like', Str::slug($lesson_name).'%')->get()->count();
            if($count_lessson > 0){ 
              $pre_slug = "-".$count_lessson;
            }

            $input['slug'] = Str::slug($lesson_name).$pre_slug;
            
            $parent_lesson_name = is_null(@$row[1]) ? '' : @$row[1];
            
            $input['sub_lesson'] = 0;

            if($parent_lesson_name != '') {
                
                $sub_lesson = Lesson::where('lesson_name',$parent_lesson_name)->where('is_deleted','0')->get()->first();
            
                if($sub_lesson) {
                    $input['sub_lesson'] = $sub_lesson->id;
                }
            }
            
            $input['lesson_type'] = is_null(@$row[2]) ? '' : @$row[2];
            
            $phase_name = is_null(@$row[3]) ? '' : @$row[3];
            
            $input['phase_id'] = 0;

            if($phase_name != '') {
                
                $phase = Phase::where('name',$phase_name)->where('is_deleted','0')->get()->first();
            
                if($phase) {
                    $input['phase_id'] = $phase->id;
                }
            }
            
            $part_name = is_null(@$row[4]) ? '' : @$row[4];
            
            $input['part_id'] = 0;

            if($part_name != '') {
                
                $part = Part::where('name',$part_name)->where('is_deleted','0')->get()->first();
            
                if($part) {
                    $input['part_id'] = $part->id;
                }
            }
            
            $input['order'] = is_null(@$row[5]) ? 0 : @$row[5];
            
            if(!is_int($input['order'])) {
                $input['order'] = 0;
            }
            
            $quiz_name = is_null(@$row[6]) ? '' : @$row[6];
            
            $input['quiz_id'] = 0;

            if($quiz_name != '') {
                
                $quiz = Quiz::where('quiz_name',$quiz_name)->where('is_deleted','0')->get()->first();
            
                if($quiz) {
                    $input['quiz_id'] = $quiz->id;
                }
            }
            
            $input['wistia_video_id'] = is_null(@$row[7]) ? '' : @$row[7];
            $input['video_length'] = is_null(@$row[8]) ? '' : @$row[8];
            $input['structured_transcript'] = is_null(@$row[9]) ? '' : @$row[9];
            $input['key_points'] = is_null(@$row[10]) ? '' : @$row[10];
            

            if($flag==1)
            {
                $input->save();
                $data = [
                    [$input->id, $input->lesson_name, $parent_lesson_name, $input->lesson_type, $phase_name, $part_name, $input->order, $quiz_name, $input->wistia_video_id, $input->video_length, $input->structured_transcript, $input->key_points, '']
                ];
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Lessons')->append($data);
                
                if(isset($values->updates->updatedRange)) {
                    $lesson_update = Lesson::find($input->id);  
                    $lesson_update->sheet_range = $values->updates->updatedRange;
                    $lesson_update->save();
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

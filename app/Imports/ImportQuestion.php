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
use App\Models\Question;
use DB;

class ImportQuestion implements ToCollection, WithStartRow
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
            $input = new Question();

            $input['question'] = is_null(@$row[0]) ? '' : @$row[0];

            $pre_slug = '';
            $count_question = Question::where("slug",'like', Str::slug($input['question']).'%')->get()->count();
            if($count_question > 0){ 
              $pre_slug = "-".$count_question;
            }
            
            $input['slug'] = Str::slug($input['question']).$pre_slug;
            
            $quiz_name = is_null(@$row[1]) ? '' : @$row[1];
            
            $input['quiz_id'] = 0;

            if($quiz_name != '') {
                
                $quiz = Quiz::where('quiz_name',$quiz_name)->where('is_deleted','0')->get()->first();
            
                if($quiz) {
                    $input['quiz_id'] = $quiz->id;
                } else {
                    $quiz_name = '';
                }
            }
            
            $input['order'] = is_null(@$row[2]) ? 0 : @$row[2];
            
            if(!is_int($input['order'])) {
                $input['order'] = 0;
            }
            
            $input['more_information'] = is_null(@$row[3]) ? '' : @$row[3];
            $input['question_type'] = is_null(@$row[4]) ? '' : @$row[4];
            $input['correct_answer'] = '';
            
            $answer = array();
            
            if(!empty(@$row[5])) {
                $answer[] = @$row[5];
            }
            if(!empty(@$row[6])) {
                $answer[] = @$row[6];
            } 
            if(!empty(@$row[7])) {
                $answer[] = @$row[7];
            } 
            if(!empty(@$row[8])) {
                $answer[] = @$row[8];
            } 
            if(!empty(@$row[9])) {
                $answer[] = @$row[9];
            } 
            if(!empty(@$row[10])) {
                $answer[] = @$row[10];
            } 
            if(!empty(@$row[11])) {
                $answer[] = @$row[11];
            } 
            if(!empty(@$row[12])) {
                $answer[] = @$row[12];
            } 
            if(!empty(@$row[13])) {
                $answer[] = @$row[13];
            } 
            if(!empty(@$row[14])) {
                $answer[] = @$row[14];
            }

            $input['answer'] = (count($answer) > 0) ? json_encode($answer) : '';

            if($flag==1)
            {
                $input->save();
                
                $optionA = $optionB = $optionC = $optionD = $optionE = $optionF = $optionG = $optionH = $optionI = $optionJ = '';
            
                if(!empty($input->answer) && $input->answer != 'null') {
                    $ans = json_decode($input->answer, true);
                    
                    $i = 'A';
                    
                    foreach($ans as $ans_data) {
                        
                        $j = 'option'.$i;
                        
                        $$j = $ans_data;
                        $i++;
                    }
                }
                
                $data = [
                    [$input->id, $input->question, $quiz_name, $input->order, $input->more_information, $input->question_type, $optionA, $optionB, $optionC, $optionD, $optionE, $optionF, $optionG, $optionH, $optionI, $optionJ, '']
                ];
                $values =   Sheets::spreadsheet(config('google.spreadsheets_id'))->sheet('Questions')->append($data);
                
                if(isset($values->updates->updatedRange)) {
                    $question_update = Question::find($input->id);  
                    $question_update->sheet_range = $values->updates->updatedRange;
                    
                    $max_sheet_column = Question::select('sheet_column')->where('quiz_id',$input['quiz_id'])->orderBy('sheet_column','DESC')->get()->first();
            
                    $col = 'D';
                    
                    if($max_sheet_column->sheet_column != null && !empty($max_sheet_column->sheet_column)) {
                        $max_sheet_column->sheet_column++;
                        $col = $max_sheet_column->sheet_column;
                    }
                 
                    $quiz_data = [
                        [$input['question']]
                    ];
                    
                    $d = Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->sheetList();
        
                    $sheet_name = isset($d[$quiz->sheet_id]) ? $d[$quiz->sheet_id] : '';
                    
                    if($sheet_name != '') {
                        $quiz_values =   Sheets::spreadsheet(config('google.spreadsheets_id_quiz'))->range($col.'1')->sheet($sheet_name)->update($quiz_data);
                        $question_update->sheet_column = $col;
                    }
                    
                    $question_update->save();
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

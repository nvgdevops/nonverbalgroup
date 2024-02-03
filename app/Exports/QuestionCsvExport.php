<?php
namespace App\Exports;

use App\Models\Quiz;
use App\Models\Question;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuestionCsvExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'question.csv';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::CSV;
    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
	    return ['Question','Quiz Name','Order','More Information','Question Type(answer/ranking/multiple)','Option A','Option B','Option C','Option D','Option E','Option F','Option G','Option H','Option I','Option J'];
    }

    public function collection()
    {
		$questions = Question::join('quizzes','questions.quiz_id','=','quizzes.id')
            ->select('questions.question','questions.order','questions.more_information', 'questions.question_type', 'questions.answer', 'quizzes.quiz_name')
            ->where('questions.is_deleted','0')
            ->get();
            
        $output = [];
        foreach ($questions as $question)
        {
            $optionA = $optionB = $optionC = $optionD = $optionE = $optionF = $optionG = $optionH = $optionI = $optionJ = '';
            
            if(!empty($question->answer) && $question->answer != 'null') {
                $ans = json_decode($question->answer, true);
                
                $i = 'A';
                
                foreach($ans as $ans_data) {
                    
                    $j = 'option'.$i;
                    
                    $$j = $ans_data;
                    $i++;
                }
            }
            
            
            $output[] = [
                $question->question,
                $question->quiz_name,
                $question->order,
                $question->more_information,
                $question->question_type,
                $optionA,
                $optionB,
                $optionC,
                $optionD,
                $optionE,
                $optionF,
                $optionG,
                $optionH,
                $optionI,
                $optionJ
            ];
        }
        
        return  collect($output);
    }
}

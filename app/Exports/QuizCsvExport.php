<?php
namespace App\Exports;

use App\Models\Quiz;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuizCsvExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'quiz.csv';
    
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
	    return ['Quiz Name'];
    }

    public function collection()
    {
		$quizs = Quiz::where('is_deleted','0')->get();;
        $output = [];
        foreach ($quizs as $quiz)
        {
          $output[] = [
            $quiz->quiz_name
          ];
        }
        
        return  collect($output);
    }
}

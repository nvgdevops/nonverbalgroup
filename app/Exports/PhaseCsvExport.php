<?php
namespace App\Exports;

use App\Models\Course;
use App\Models\Phase;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PhaseCsvExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'phase.csv';
    
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
	    return ['Name','Length','Title','Course','Order','Description'];
    }

    public function collection()
    {
		$phases = Phase::leftjoin('courses','phases.course_id','=','courses.id')
                 ->select('courses.name as course_name', 'phases.*')->where('phases.is_deleted','0')->get();;
        $output = [];
        foreach ($phases as $phase)
        {
          $output[] = [
            $phase->name,
            $phase->phase_length,
            $phase->phase_title,
            $phase->course_name,
            $phase->order,
            $phase->phase_dec
          ];
        }
        
        return  collect($output);
    }
}

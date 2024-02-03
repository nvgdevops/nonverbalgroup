<?php
namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CourseCsvExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'course.csv';
    
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
	    return ['Name'];
    }

    public function collection()
    {
		$courses = Course::where('is_deleted','0')->get();;
        $output = [];
        foreach ($courses as $course)
        {
          $output[] = [
            $course->name
          ];
        }
        
        return  collect($output);
    }
}

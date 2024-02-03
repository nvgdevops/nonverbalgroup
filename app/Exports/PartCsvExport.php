<?php
namespace App\Exports;

use App\Models\Part;
use App\Models\Phase;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PartCsvExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'part.csv';
    
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
	    return ['Name','Length','Phase','Order'];
    }

    public function collection()
    {
		$parts = Part::leftJoin('phases','parts.phase_id','=','phases.id')
                 ->select('parts.name', 'parts.order', 'phases.name as phase_name','parts.id')->where('parts.is_deleted','0')->get();
        $output = [];
        foreach ($parts as $part)
        {
          $output[] = [
            $part->name,
            $part->part_length,
            $part->phase_name,
            $part->order
          ];
        }
        
        return  collect($output);
    }
}

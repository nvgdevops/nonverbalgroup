<?php
namespace App\Exports;

use App\Models\Lesson;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LessonCsvExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'lesson.csv';
    
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
	    return ['Lesson', 'Parent Lesson','Lesson Type(assessment/training)','Phase','Part','Order','Quiz','Video ID','Video/Assessment Length','Structured Transcript','Key Points'];
    }

    public function collection()
    {
		$lessons = Lesson::leftJoin('phases','lessons.phase_id','=','phases.id')
                  ->leftJoin('parts','lessons.part_id','=','parts.id')
                  ->leftJoin('quizzes','lessons.quiz_id','=','quizzes.id')
                  ->leftJoin('lessons as subLesson','lessons.sub_lesson','=','subLesson.id')
                  ->select('lessons.lesson_name', 'lessons.video_length', 'subLesson.lesson_name as sub_lesson_name', 'lessons.order', 'phases.name','lessons.lesson_type','lessons.id','parts.name as pname','quizzes.quiz_name','lessons.wistia_video_id','lessons.structured_transcript','lessons.key_points')->where('lessons.is_deleted','0')->get();
        $output = [];
        foreach ($lessons as $lesson)
        {
          $output[] = [
            $lesson->lesson_name,
            $lesson->sub_lesson_name,
            $lesson->lesson_type,
            $lesson->name,
            $lesson->pname,
            $lesson->order,
            $lesson->quiz_name,
            $lesson->wistia_video_id,
            $lesson->video_length,
            $lesson->structured_transcript,
            $lesson->key_points
            
          ];
        }
        
        return  collect($output);
    }
}

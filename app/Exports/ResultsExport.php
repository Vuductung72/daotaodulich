<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ResultsExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $results;
    protected $stt = 1;

    public function __construct(\Illuminate\Support\Collection $results)
    {
        $this->results = $results;
    }

     public function result($results){
        if($results->answer != [] OR $results->answer != '' ){
            $arrQuestion = json_decode($results->answer,true);
            $numberQuestion = array_count_values($arrQuestion);
            $numberQuestion = isset($numberQuestion['1']) ? $numberQuestion['1'] : 0;  
            return 'Đúng: ' . $numberQuestion. '/' .$results->exam->examQuestions->count() . ' câu';
        }else{
            return 'Đúng: 0/' .$results->exam->examQuestions->count() . ' câu';
        }
    } 
    
    public function collection()
    {
        return $this->results;
    }
    // add title for sheet 
    public function headings() :array {
        return ["STT", "Họ tên", "Email", "Tên khóa học", "Thể loại", "Kết quả", "Trạng thái", "Ngày thi"];
    }
    // map data from web into excel 
    public function map($results): array
    {
        return [
            $this->stt ++,
            $results->user->name,
            $results->user->email,
            $results->course ? $results->course->name : '...',
            $results->type === 1 ? 'Thi thật' : 'Thi thử',
            $this->result($results),
            $results->status ? 'Đạt' : 'Chưa đạt',
            \Carbon\Carbon::createFromDate($results->created_at)->format('d/m/Y')
        ];
    }

    public function registerEvents(): array
    {
        return [
            // text align center after sheet creat success 
            AfterSheet::class => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:J1000')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class QuestionsExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $questions;
    protected $stt = 1;

    public function __construct(\Illuminate\Support\Collection $questions)
    {
        $this->questions = $questions;
    }

    public function collection()
    {
        return $this->questions;
    }
    // add title for sheet 
    public function headings() :array {
        return ["STT", "Tên câu hỏi", "Nội dung", "Ngành nghề", "Thể loại","Ngày tạo"];
    }
    // map data from web into excel 
    public function map($questions): array
    {
        return [
            // $questions->id,
            $this->stt ++,
            $questions->name,
            $questions->content,
            $questions->profession->name,
            $questions->type == 0 ? 'Câu hỏi ôn tập' : 'Câu hỏi thi',
            $questions->created_at->format('d-m-Y')
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
<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize,WithEvents
{

    protected $users;

    public function __construct(\Illuminate\Support\Collection $users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }
    // add title for sheet 
    public function headings() :array {
        return ["ID", "Tên học viên", "Giới tính", "Email", "Trạng thái Email", "Số điện hoại", "Địa chỉ", "Số tiền trong tài khoản (vnđ)", "Ngày tạo", "Thời gian đăng nhập gần nhất"];
    }
    // map data from web into excel 
    public function map($users): array
    {
        return [
            $users->id,
            $users->name,
            $users->gender == 1 ? 'Nam' : 'Nữ',
            $users->email,
            $users->email_verified == 1 ? "Đã xác thực" : "Chưa xác thực", 
            $users->phone,
            $users->address,
            $users->money ? number_format($users->money,0,".",",") : '0',
            $users->created_at->format('d-m-Y'),
            \Carbon\Carbon::createFromDate($users->last_login)->format('H:i:s | d-m-Y'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            // text align center after sheet creat success 
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:J1000')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
}

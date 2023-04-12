<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel;
use App\Models\User;

    class UsersExport implements 
        FromCollection,
        WithHeadings,
        WithCustomStartCell,
        WithProperties,
        ShouldAutoSize,
        WithStyles,
        Responsable

{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return User::all();
    }

    public function properties(): array
    {
        return [
            'creator'   => 'Nuri Anıl Demirbaş',
            'title'     => 'Web Dev NAD | User List',
            'subject'   => 'Test',
            'company'   => 'NAD Test Company',
        ];
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Email Verified At',
            'password',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'two_factor_confirmed_at',
            'remember_token',
            'current_team_id',
            'profile_photo_path',
            'created_at',
            'updated_at',
        ];
    }

    public function startCell(): string
    {
        return "A1";
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => TRUE ]],
            'B1' => ['font' => ['bold' => TRUE ]],
            'C1' => ['font' => ['bold' => TRUE ]],
            'D1' => ['font' => ['bold' => TRUE ]],
            'E1' => ['font' => ['bold' => TRUE ]],
            'F1' => ['font' => ['bold' => TRUE ]],
            'G1' => ['font' => ['bold' => TRUE ]],
            'H1' => ['font' => ['bold' => TRUE ]],
            'I1' => ['font' => ['bold' => TRUE ]],
            'J1' => ['font' => ['bold' => TRUE ]],
            'K1' => ['font' => ['bold' => TRUE ]],
            'L1' => ['font' => ['bold' => TRUE ]],
            'M1' => ['font' => ['bold' => TRUE ]],
            'N1' => ['font' => ['bold' => TRUE ]],
        ];
    }

    /** EĞER CONTROLLER.PHP DE ->DOWNLOAD() FONKSİYONU VE PARAMETLERİ BURDA YAZIP ->DOWNLOAD() KULLANMADAN İNDERMEK İÇİN */
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'test.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = \Maatwebsite\Excel\Excel::XLSX;
    // private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'application/vnd.ms-excel',
    ];

    /** EĞER CONTROLLER.PHP DE ->DOWNLOAD() FONKSİYONU VE PARAMETLERİ BURDA YAZIP ->DOWNLOAD() KULLANMADAN İNDERMEK İÇİN */
    
}

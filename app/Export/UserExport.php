<?php

namespace App\Export;

use App\Export\Sheets\UserExportSheet;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UserExport implements FromCollection, WithHeadings, WithMultipleSheets
{
    use Exportable;
    protected $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        return User::select(['id', 'name', 'email'])->get();
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
        ];
    }
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new UserExportSheet($this->year, $month);
        }

        return $sheets;
    }
}

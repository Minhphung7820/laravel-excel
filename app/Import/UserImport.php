<?php

namespace App\Import;

use App\Import\FirstSheetImport;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class UserImport implements WithMultipleSheets
{
    // use WithConditionalSheets;

    public function sheets(): array
    {
        return [
            'job_titles' => new FirstSheetImport(),
            'departments' => new SecondSheetImport(),
            'positions' => new ThirdSheetImport(),
            'employees' => new EmployeeImport(),
        ];
    }
}

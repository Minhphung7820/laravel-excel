<?php

namespace App\Import;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Position;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToArray;

class EmployeeImport implements ToArray, WithStartRow
{
  public function array(array $rows)
  {
    $keys = array_shift($rows); // Loại bỏ hàng đầu tiên và lấy nó làm key

    $newData = array_map(function ($row) use ($keys) {
      return array_combine($keys, $row);
    }, $rows);

    foreach ($newData as $row) {
      $position = Position::where('code', $row['position_code'])->first();
      $department = Department::where('code', $row['department_code'])->first();
      $job = JobTitle::where('code', $row['job_code'])->first();
      Employee::updateOrCreate(
        [
          'full_name' => $row['full_name'],
          'position_id' => $position ? $position->id : null,
          'department_id' => $department ? $department->id : null,
          'job_id' => $job ? $job->id : null,
        ]
      );
    }
  }

  public function startRow(): int
  {
    return 1; // Bắt đầu xử lý từ hàng số 2 để bỏ qua hàng tiêu đề
  }
}

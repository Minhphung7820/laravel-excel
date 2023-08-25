<?php

namespace App\Import;

use App\Models\Department;
use App\Models\JobTitle;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;

class SecondSheetImport implements ToArray, WithStartRow
{
  public function array(array $rows)
  {
    $keys = array_shift($rows); // Loại bỏ hàng đầu tiên và lấy nó làm key

    $newData = array_map(function ($row) use ($keys) {
      return array_combine($keys, $row);
    }, $rows);

    foreach ($newData as $row) {
      Department::updateOrCreate(
        [
          'code' => $row['code'],
        ],
        ['name' => $row['name'],]
      );
    }
  }

  public function startRow(): int
  {
    return 1; // Bắt đầu xử lý từ hàng số 2 để bỏ qua hàng tiêu đề
  }
}

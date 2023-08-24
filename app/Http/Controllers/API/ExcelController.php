<?php

namespace App\Http\Controllers\API;

use App\Export\UserExport;
use App\Http\Controllers\Controller;
use App\Import\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport(2023), 'danh_sach_nguoi_dung.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new UserImport, $request->file('file'));
        echo "Đã import";
    }
}

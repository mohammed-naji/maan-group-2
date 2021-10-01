<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductsExport, 'products-backup.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('data'));
        return redirect()->back();
    }
}

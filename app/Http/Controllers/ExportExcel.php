<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;

class ExportExcel extends Controller
{
    public function exportUsers(){

        // dd(UsersExport::class);

        return new UsersExport();
        // return Excel::download(new UsersExport, 'Fake Users - '.time().'.xlsx');
        // return Excel::download(new UsersExport, 'Fake Users - '.time().'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        // return Excel::download(new UsersExport, 'Fake Users - '.time().'.html', \Maatwebsite\Excel\Excel::HTML);
    }


}

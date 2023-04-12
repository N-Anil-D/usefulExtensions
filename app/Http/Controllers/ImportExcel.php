<?php

namespace App\Http\Controllers;

use App\Imports\TestImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportExcel extends Controller
{
    public function importExcel(){
        
        Excel::import(new TestImport, request()->file);
    }

    public function downloadExampleExcel(){

        $file= public_path('ExampleImportExcel.xlsx');
        dd($file);

        $headers = array(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        // return response()->download($file);
        return response()->download($file,'ExampleImportExcel.xlsx',$headers);
    }
    
}

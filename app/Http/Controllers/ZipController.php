<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zip;


class ZipController extends Controller
{
    public function index(){
        $option = request("option");
        if ($option == "open") {
            $open_zip = Zip::open(public_path('TEST.zip'));
            dd($open_zip);
        } elseif($option == "create") {
            $zip = Zip::create('TEST.zip');
            dd($zip);
        } elseif($option == "check") {
            $is_valid = Zip::check('TEST.zip');
            dd($is_valid);
        } elseif($option == "has") {
            $zip = Zip::open('TEST.zip');
            // $zip = Zip::open(public_path('TEST.zip'));
            $has = $zip->has('/path/to/file/in/archive');
            dd(Zip::open('TEST.zip'),$has);
        }elseif($option == "uncompressed") {
            // $zip = Zip::open(public_path('TEST.zip'));
            $zip = Zip::create('TEST.zip');
            // $zip = Zip::check('TEST.zip');

            // $zip->extract('/uncompressed/zipFiles');
            dd($zip->extract('/uncompressed/zipFiles'));
        }elseif($option == "addByPath") {
            $zip = Zip::create('nadTestProject.zip');
            $zip->setPath(public_path('/'))->add('myfile.pdf');
        }else{
            dd(request("option"));
        }
        
        // dd(Zip::open(public_path('ExampleImportExcel.xlsx')));

    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\ExampleKgsUsersSchema;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\KgsUsers;
use App\Imports\KgsUsersImport;

class KgsController extends Controller
{
    public function index(){
        
        return view('kgsTable',['kgsUsersAll'=>KgsUsers::all()]);
    }

    public function importUsers(){
        
        Excel::import(new KgsUsersImport, request()->file);
    }

    public function exampleInsertUsers(){
        
        // return Excel::download(new ExampleKgsUsersSchema, 'test123'.'.xlsx');
        return new ExampleKgsUsersSchema();
        // return Excel::download(new ExampleKgsUsersSchema);

    }
}

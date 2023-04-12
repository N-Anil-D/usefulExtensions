<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportPDF extends Controller
{
    public function exportUsers(){

        $users = User::all();
        // return view('testPDF',['users' => $users]);
        $pdf = Pdf::loadView('testPDF', ['users' => $users]);
        // Pdf::loadHTML(view('testPDF', ['users' => $users]))->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
        // return $pdf->stream('ExportUsers.pdf');
        return $pdf->download('ExportUsers.pdf');

    }
}

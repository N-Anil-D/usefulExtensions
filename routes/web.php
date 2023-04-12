<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{ExportExcel, ImportExcel, ExportPDF, TelegramController, ZipController};
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () { return Inertia::render('Dashboard');})->name('dashboard');
        Route::get('/export-users/export-excel', [ExportExcel::class,'exportUsers'])->name('export.users.excel');
        Route::post('/import/excel', [ImportExcel::class,'importExcel'])->name('import.excel');
        Route::get('/import/excel/example/download', [ImportExcel::class,'downloadExampleExcel'])->name('import.excel.example.download');
        Route::get('/export-users/export-pdf', [ExportPDF::class,'exportUsers'])->name('export.users.pdf');
        Route::get('/get-telegram-updates', [TelegramController::class,'updates'])->name('telegram.updates');
        Route::get('/telegram-send-message', [TelegramController::class,'sendMessage'])->name('telegram.send.message');
        Route::get('/zip', [ZipController::class,'index'])->name('zip.index');
        // Route::post('/test-pusher', [PusherTestController::class,'sendMessage'])->name('telegram.send.message');
        Route::get('test/name?', function () {
            event(new App\Events\PusherTestEvent('name?'));
            return "Event has been sent!";
        });
        
    });

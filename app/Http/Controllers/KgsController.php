<?php

namespace App\Http\Controllers;

use App\Exports\ExampleKgsUsersSchema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{KgsUsers, KgsGiris, KgsCikis, KgsPuantaj, KgsHataliPuantaj};
use App\Imports\{KgsUsersImport, KgsLoginImport, KgsLogoutImport};
use Carbon\Carbon;
use Carbon\CarbonInterval;

class KgsController extends Controller
{
    public function index(){
        
        return view('kgsTable',['kgsUsersAll'=>KgsUsers::all()]);
    }

    public function importUsers(Request $request){
        
        Validator::validate($request->all(), [
            'file' => [ 'required','mimes:xlsx,xls']
        ]);
        Excel::import(new KgsUsersImport, request()->file);
    }

    public function importLogin(Request $request){
        
        Validator::validate($request->all(), [
            'file' => [ 'required','mimes:xlsx,xls']
        ]);
        Excel::import(new KgsLoginImport, request()->file);
    }

    public function importLogout(Request $request){
        
        Validator::validate($request->all(), [
            'file' => [ 'required','mimes:xlsx,xls']
        ]);
        Excel::import(new KgsLogoutImport, request()->file);
    }

    public function exampleInsertUsers(){
        
        return new ExampleKgsUsersSchema();
    }

    private function giris0cikis0($kgsUser){
        $puantaj = new KgsPuantaj;
        $puantaj->kgs_id = $kgsUser->kgs_id;//kgs_id
        $puantaj->geldi = 0;
        $puantaj->calisma_dakika = 0;
        $puantaj->save();
        if (!is_null($kgsUser->kgsUsrToLogin)) {
            $kgsUser->kgsUsrToLogin->delete();
        }
        if (!is_null($kgsUser->kgsUsrToLogout)) {
            $kgsUser->kgsUsrToLogout->delete();
        }
}
    private function giris1cikis0($kgsUser, $giris, $cikis=null){
        $multiLogin = $kgsUser->kgsUsrToLoginMultiple;
        if ($multiLogin->count() > 1) {//girişi olan biri çıkış yapmadan başka giriş yaparsa 8 saatlik mesai yaz
            $enErkenGiris = Carbon::parse($kgsUser->kgsUsrToLoginMultiple->first()->giris);
            $multiLogin->shift();
            foreach ($multiLogin as $login) {//8 saat içerisindeki çoklu kayıtları silip en erken olanını bırak
                if(!is_null($login->giris)){
                    if ($enErkenGiris->diffInMinutes(Carbon::parse($login->giris)) < 480) {
                        $login->delete();
                    }
                }
            }
            $giris = $enErkenGiris;
            $currentYear    = $giris->format('Y');
            $currentMonth   = $giris->format('m');
            $currentDay     = $giris->format('d');
            $girisSifir = Carbon::create($currentYear, $currentMonth, $currentDay, 0, 0);
            $girisSabah = Carbon::create($currentYear, $currentMonth, $currentDay, 5, 0);
            $girisGunici = Carbon::create($currentYear, $currentMonth, $currentDay, 16, 30);
            $girisAksam = Carbon::create($currentYear, $currentMonth, $currentDay, 20, 0);
            if($giris->between($girisSifir,$girisSabah)){
                $cikis = Carbon::create($currentYear, $currentMonth, $currentDay, 8, 30);
            }else if ($giris->between($girisSabah,$girisGunici)){
                $cikis = Carbon::create($currentYear, $currentMonth, $currentDay, 17, 30);
            }else if ($giris->between($girisGunici,$girisAksam)){
                $cikis = Carbon::create($currentYear, $currentMonth, $currentDay+1, 00, 30);
            }else{
                $cikis = Carbon::create($currentYear, $currentMonth, $currentDay+1, 00, 30);
            }
            $puantaj = new KgsPuantaj;
            $puantaj->kgs_id = $kgsUser->kgs_id;
            $puantaj->giris = $giris->format('Y-m-d H:i:s');
            $puantaj->cikis = $cikis->format('Y-m-d H:i:s');
            $puantaj->calisma_dakika = $giris->diffInMinutes($cikis);
            $puantaj->geldi = 1;
            $puantaj->save();
            $kgsUser->kgsUsrToLogin->delete();
            $kgsUser->kgsUsrToLogout->delete();
        }else {
            if (Carbon::now() > Carbon::parse($giris)->addHours(36)) {//girişten itibareen 36 saat geçmişse ve başka giriş/çıkış işlemi yok ise 8 saatlik mesai sayılır
                $cikis = Carbon::parse($giris)->addHours(8);
                if($giris->diffInMinutes($cikis)>1000){
                    dd($giris->diffInMinutes($cikis),$giris,$cikis);
                }
                $puantaj = new KgsPuantaj;
                $puantaj->kgs_id = $kgsUser->kgs_id;
                $puantaj->giris = $giris->format('Y-m-d H:i:s');
                $puantaj->cikis = $cikis->format('Y-m-d H:i:s');
                $puantaj->calisma_dakika = $giris->diffInMinutes($cikis);
                $puantaj->geldi = 1;
                $puantaj->save();
                if (!is_null($kgsUser->kgsUsrToLogin)) {
                    $kgsUser->kgsUsrToLogin->delete();
                }
                if (!is_null($kgsUser->kgsUsrToLogout)) {
                    $kgsUser->kgsUsrToLogout->delete();
                }
            }
        }    
    }
    private function giris0cikis1($kgsUser, $giris=null, $cikis){
        $hataliPuantaj = new KgsHataliPuantaj;
        $hataliPuantaj->kgs_id = $kgsUser->kgs_id;
        $hataliPuantaj->giris = $giris;
        $hataliPuantaj->cikis = $cikis->format('Y-m-d H:i:s');
        $hataliPuantaj->save();
        $kgsUser->kgsUsrToLogin->delete();
        $kgsUser->kgsUsrToLogout->delete();
    }
    private function giris1cikis1($kgsUser, $giris, $cikis){
        // $calismaSuresiSaat = CarbonInterval::minutes($dakikaFarkı)->cascade()->total('hours'); //saat hesabı
        if ($cikis < $giris) {
            $cikis = Carbon::parse($giris)->addHours(8)->addMinute(30);
        }
        $puantaj = new KgsPuantaj;
        $puantaj->kgs_id = $kgsUser->kgs_id;
        $puantaj->giris = $giris->format('Y-m-d H:i:s');
        $puantaj->cikis = $cikis->format('Y-m-d H:i:s');
        $puantaj->calisma_dakika = $giris->diffInMinutes($cikis);
        $puantaj->geldi = 1;
        $puantaj->save();
        $kgsUser->kgsUsrToLogin->delete();
        $kgsUser->kgsUsrToLogout->delete();

    }

    public function activity(){
        foreach (KgsUsers::all() as $kgsUser) {
            if(!is_null($kgsUser->kgsUsrToLogin) && !is_null($kgsUser->kgsUsrToLogout)){
                $giris = Carbon::parse($kgsUser->kgsUsrToLogin->giris);
                $cikis = Carbon::parse($kgsUser->kgsUsrToLogout->cikis);
                if (is_null($kgsUser->kgsUsrToLogin->giris) && is_null($kgsUser->kgsUsrToLogout->cikis)) {
                    
                    $this->giris0cikis0($kgsUser);
                    
                }else if (is_null($kgsUser->kgsUsrToLogin->giris) && !is_null($kgsUser->kgsUsrToLogout->cikis)) {
                    
                    $this->giris0cikis1($kgsUser,null,$cikis);
                    
                }else if(!is_null($kgsUser->kgsUsrToLogin->giris) && is_null($kgsUser->kgsUsrToLogout->cikis)){
                    
                    $this->giris1cikis0($kgsUser,$giris,null);
                    
                }else if(!is_null($kgsUser->kgsUsrToLogin->giris) && !is_null($kgsUser->kgsUsrToLogout->cikis)){
                    
                    $this->giris1cikis1($kgsUser,$giris,$cikis);
                    
                }
            }else if (!is_null($kgsUser->kgsUsrToLogin) && is_null($kgsUser->kgsUsrToLogout)){
                $giris = Carbon::parse($kgsUser->kgsUsrToLogin->giris);
                $this->giris1cikis0($kgsUser,$giris,null);
            }else if (is_null($kgsUser->kgsUsrToLogin)){
                $this->giris0cikis0($kgsUser);
            }
        }
    }

    public function test(){
        $asd = KgsUsers::where('kgs_id',1258997513)->with('kgsUsrToLogout','kgsUsrToLogin')->first();
        // $asd = KgsUsers::where('kgs_id',1322413918)->with('kgsUsrToLogout')->get();

        dd($asd);
    }
}

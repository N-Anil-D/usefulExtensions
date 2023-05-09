<?php

namespace App\Imports;

use App\Models\KgsCikis;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class KgsLogoutImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $currentDate     = Carbon::parse($row['cikis']);
        $currentYear     = $currentDate->format('Y');
        $currentMonth     = $currentDate->format('m');
        $currentDay     = $currentDate->format('d');
        // $sabahCikis = Carbon::create($currentYear, $currentMonth, $currentDay, 8, 0);
        // $sabahCikis2 = Carbon::create($currentYear, $currentMonth, $currentDay, 9, 0);
        $cikis17 = Carbon::create($currentYear, $currentMonth, $currentDay, 17, 0);
        $cikis18 = Carbon::create($currentYear, $currentMonth, $currentDay, 18, 0); 
        if ($currentDate->between($cikis17,$cikis18)) {
            $row['cikis'] = Carbon::create($currentYear, $currentMonth, $currentDay, 17, 30)->toDateTimeString();
        }
        return new KgsCikis([
            'kgs_id' =>$row['kgs_id'],
            'cikis' =>$row['cikis'],
        ]);
    }
}

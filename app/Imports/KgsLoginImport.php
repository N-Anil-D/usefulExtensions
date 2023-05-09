<?php

namespace App\Imports;

use App\Models\KgsGiris;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class KgsLoginImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!is_null($row['giris'])) {
            $giris = $row['giris'];
            $currentDate     = Carbon::parse($row['giris']);
            $currentHour     = $currentDate->format('H');
            
            if ($currentHour == 8) {
                $currentYear     = $currentDate->format('Y');
                $currentMonth     = $currentDate->format('m');
                $currentDay     = $currentDate->format('d');
                $giris = Carbon::create($currentYear, $currentMonth, $currentDay, 8, 30)->toDateTimeString();
            }else{
                $giris = $currentDate->toDateTimeString();

            }
        }else{
            $giris = null;
        }

        return new KgsGiris([
            'kgs_id' =>$row['kgs_id'],
            'giris' =>$giris,
        ]);
    }
}

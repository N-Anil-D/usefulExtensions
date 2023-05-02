<?php

namespace App\Imports;

use App\Models\KgsUsers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KgsUsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct(){
        KgsUsers::truncate();
    }
    public function model(array $row)
    {
        return new KgsUsers([
            'kgs_id' => $row['kgs_id'],
            'name' => $row['name'],
            'shift' => 0,
        ]);
    }
}

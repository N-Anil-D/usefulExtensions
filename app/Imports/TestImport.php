<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use App\Models\TestTableManager;

class TestImport implements ToModel,WithHeadingRow,WithUpserts
{
    /**
    * @param Collection $collection
    */
    // /*
    public function model(array $row)
    {
        //with Maatwebsite\Excel\Concerns\WithHeadingRow;
        $newLine = new TestTableManager();
        $newLine->t1 = $row['asd'];
        $newLine->t2 = $row['qwe'];
        $newLine->t3 = $row['zxc'];
        $newLine->save();
    }
    // */
    /*
    public function model(array $row)
    {
        //without Maatwebsite\Excel\Concerns\WithHeadingRow;
        $newLine = new TestTableManager();
        $newLine->t1 = $row[0];
        $newLine->t2 = $row[1];
        $newLine->t3 = $row[2];
        $newLine->save();
    }
    */
    public function uniqueBy()
    {
        return 't1';
    }
}

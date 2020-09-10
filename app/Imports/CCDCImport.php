<?php

namespace App\Imports;

use App\CCDC;
use Maatwebsite\Excel\Concerns\ToModel;

class CCDCImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CCDC([
            'MaCCDC' => $row[1],
            'MaCCDC' => $row[4],
            'MaCCDC' => $row[5],
            'MaCCDC' => $row[7],
            'MaCCDC' => $row[8],

                    ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Tender;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TenderImport implements ToModel, WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tender([
            "external_code" => $row[0] ?? 'Null',
            "number" => $row[1],
            "status" => $row[2],
            "name" => $row[3],
            "change_date" => $row[4],
        ]);
    }
}

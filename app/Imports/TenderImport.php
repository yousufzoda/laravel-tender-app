<?php

namespace App\Imports;

use App\Models\Tender;
use Maatwebsite\Excel\Concerns\ToModel;

class TenderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tender([
            "external_code" => $row['Внешний код'],
            "number" => $row['Номер'],
            "status" => $row['Статус'],
            "name" => $row['Название'],
            "updated_at" => $row['Дата изм.'],
        ]);
    }
}

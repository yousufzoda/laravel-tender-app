<?php

namespace Database\Seeders;

use App\Models\Tender;
use Illuminate\Database\Seeder;

class TenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tender::truncate();

        $csvFile = fopen(public_path("data/test_task_data.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Tender::create([
                    "external_code" => $data['0'],
                    "number" => $data['1'],
                    "status" => $data['2'],
                    "name" => $data['3'],
                    "date" => $data['4']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);

    }
}

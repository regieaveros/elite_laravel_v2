<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rank::truncate();

        $csvFile = fopen(base_path("database/data/ranks.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Rank::create([
                    "code" => $data['0'],
                    "name" => $data['1'],
                    "alias" => $data['2'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

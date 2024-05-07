<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Gener_movieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv',file(storage_path('csvs/gener_movie.csv')));
        foreach($csv as $row){
            DB::table('gener_movie')->insert([
                    'generId' => $row[0],
                    'movieId' => $row[1]
            ]);
        }
    }
}

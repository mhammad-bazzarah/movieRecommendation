<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv',file(storage_path('csvs/movies.csv')));
        foreach($csv as $row){
            DB::table('movies')->insert([
                'movieId' => $row[0] ,
                'title' =>   $row[1] ,
                'year' => $row[2] ,
                'rate' => $row[3],
                'numOfRatings' => $row[4]
            ]);
        }
    }
}

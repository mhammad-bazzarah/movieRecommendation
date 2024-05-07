<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv',file(storage_path('csvs/links.csv')));
        foreach($csv as $row){
            DB::table('links')->insert([
                'movieId' => $row[0] ,
                'imdbId' => $row[1] ,
                'tmdbId' => $row[2] ,
            ]);
        }

    }
}

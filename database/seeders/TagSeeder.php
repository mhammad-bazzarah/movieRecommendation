<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file(storage_path('csvs/tags.csv')));
        foreach ($csv as $row) {
            DB::table('tags')->insertGetId([
                'userId' => $row[0],
                'movieId' => $row[1],
                'tag' => $row[2],
                'timestamp' =>  Carbon::createFromTimestamp($row[3]) ,
            ]);

        }
    }
}

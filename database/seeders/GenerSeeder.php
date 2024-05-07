<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file(storage_path('csvs/geners.csv')));
        foreach ($csv as $row) {
            DB::table('geners')->insertGetId([
              'name'=> $row[1]
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Gener;
use App\Models\Rating;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->count(610)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(MovieSeeder::class);
        $this->call(LinkSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(GenerSeeder::class);
        $this->call(Gener_movieSeeder::class);
    }
}

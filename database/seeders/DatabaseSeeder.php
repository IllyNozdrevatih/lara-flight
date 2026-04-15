<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Flight;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
//        DB::table('flights')->insert([
//            'name' => Str::random(10),
//            'airline' => Str::random(10),
//        ]);

        Flight::factory()->count(100)->create();
        Airline::factory()->count(100)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create(['name' => 'Liverpool', 'power' => '5']);
        Team::create(['name' => 'Manchester City', 'power' => '4']);
        Team::create(['name' => 'Chelsea', 'power' => '3']);
        Team::create(['name' => 'Arsenal', 'power' => '3']);
    }
}

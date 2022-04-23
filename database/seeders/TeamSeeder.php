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
        Team::create(['name' => 'Liverpool', 'power' => rand(30, 100)]);
        Team::create(['name' => 'Manchester City', 'power' => rand(30, 100)]);
        Team::create(['name' => 'Chelsea', 'power' => rand(30, 100)]);
        Team::create(['name' => 'Arsenal', 'power' => rand(30, 100)]);

//        Team::create(['name' => 'Tottenham', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Manchester United', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Everton', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Watford', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Leicester', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Bournemouth', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Brighton', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Burnley', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Crystal Palace', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Newcastle', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Southampton', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Wolverhampton', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'West Ham', 'power' => rand(30, 100)]);
//        Team::create(['name' => 'Huddersfield', 'power' => rand(30, 100)]);
    }
}

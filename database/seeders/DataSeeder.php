<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VaccineCenter::factory(5)
            ->create(['limit' => 1]);

        foreach (range(1, 5) as $index) {
            User::factory(rand(1, 3))->create(['vaccine_center_id' => $index]);
            User::factory(rand(1, 3))->scheduled()->create(['vaccine_center_id' => $index]);
        }
    }
}

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
            ->sequence(fn(Sequence $sequence) => ['limit' => $sequence->index + 1])
            ->create();

        foreach (range(1, 5) as $index) {
            User::factory(rand(1, 5))->create(['vaccine_center_id' => $index]);
            User::factory(rand(1, 5))->scheduled()->create(['vaccine_center_id' => $index]);
        }
    }
}

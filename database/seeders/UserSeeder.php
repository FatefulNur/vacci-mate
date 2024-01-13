<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create();
        foreach (range(1, 50) as $index) {
            User::factory(rand(1, 10))->create(['vaccine_center_id' => $index]);
        }
    }
}

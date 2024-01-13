<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nid' => fake()->numberBetween(0000000000),
            'phone' => '01' . fake()->numberBetween(000000000, 999999999),
            'status' => UserStatus::NOT_VACCINATED,
            'vaccine_center_id' => null,
            'email_verified_at' => now(),
            'scheduled_at' => null,
        ];
    }

    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'status' => null,
            'nid' => '1234568790',
            'phone' => '01300000000',
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn(array $attributes) => [
            'scheduled_at' => now()->subHours(rand(0, 18)),
            'status' => 'scheduled',
        ]);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'user_code'=> fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'country_code' => fake()->areaCode(),
            'mobile' => Str::of(fake()->unique()->phoneNumber())->substr(0, 12),
            'label' => Str::of(fake()->jobTitle())->substr(0, 30),
            'status' => 1,
            'primary_role_id'=>3,
            'creator_id' => 1,
            'secondary_roles' => null,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(10)), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

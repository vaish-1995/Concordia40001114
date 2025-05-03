<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->firstName() . ' ' . $this->faker->lastName();
        $cleanEmail = strtolower(str_replace(' ', '.', $name)) . '@example.com';

        return [
            'name' => $name,
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $cleanEmail,
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = '2005-12-31'),
            'city_id' => City::factory(),
        ];
    }
}


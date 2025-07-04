<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Citizen>
 */
class CitizenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = ['Male', 'Female', 'Other'];
        $gender = $this->faker->randomElement($genders);

        return [
            'citizen_id'   => strtoupper(Str::random(8)),
            'first_name'   => $this->faker->firstName($gender === 'Male' ? 'male' : 'female'),
            'surname'      => $this->faker->lastName,
            'other_names'  => $this->faker->optional()->firstName,
            'hometown'     => $this->faker->city,
            'date_of_birth'=> $this->faker->date('Y-m-d', '-18 years'),
            'address'      => $this->faker->address,
            'contact_info' => $this->faker->phoneNumber,
            'gender'       => $gender,
            'nin'          => strtoupper(Str::random(12)),
            'photo_path'   => '', // Will be set in the seeder after downloading the image
        ];
    }
}

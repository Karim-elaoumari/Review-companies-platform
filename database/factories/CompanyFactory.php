<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use App\Models\Company;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence,
            'logo' => fake()->imageUrl(),
            'website' => fake()->url(),
            'founded' => fake()->datetime($format = 'Y-m-d'),
            'manager_id' => User::factory(),
            'industry_id' => Industry::factory(),
            'employees' => fake()->numberBetween($min = 1, $max = 1000),
            'revenue' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000000),
            'description' => fake()->paragraphs($nb = 3, $asText = true),
            'city_id' => City::factory(),
            'address' => fake()->address(),
            'mission' => fake()->sentence(),
            


        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Company $company) {
            $followers = User::factory()->count(3)->create();
            $company->followers()->attach($followers);
        });
    }
       
    
}

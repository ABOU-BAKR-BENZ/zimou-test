<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('store_[0-9]{4}'),
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'phones' => $this->faker->e164PhoneNumber(),
            'company_name' => $this->faker->company,
            'capital' => $this->faker->numberBetween(10000, 10000000),
            'address' => $this->faker->address,
            'register_commerce_number' => $this->faker->unique()->regexify('RC[0-9]{6}'),
            'nif' => $this->faker->unique()->regexify('NIF[0-9]{8}'),
            'legal_form' => $this->faker->numberBetween(1, 5),
            'status' => 1,
            'can_update_preparing_packages' => $this->faker->boolean,
        ];
    }
}

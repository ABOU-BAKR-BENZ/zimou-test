<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{

    protected $model = Package::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $communeIds = Commune::pluck('id')->toArray();
        $deliveryTypeIds = DeliveryType::pluck('id')->toArray();
        $statusIds = PackageStatus::pluck('id')->toArray();
        return [
            'uuid' => $this->faker->uuid,
            'tracking_code' => "ZMX-" . $this->faker->unique()->regexify('[A-Za-z0-9]{6}'),
            'commune_id' => $this->faker->randomElement($communeIds),
            'delivery_type_id' => $this->faker->randomElement($deliveryTypeIds),
            'status_id' => $this->faker->randomElement($statusIds),
            'address' => $this->faker->streetAddress,
            'can_be_opened' => $this->faker->boolean,
            'name' => $this->faker->word,
            'client_first_name' => $this->faker->firstName,
            'client_last_name' => $this->faker->lastName,
            'client_phone' => $this->faker->e164PhoneNumber(),
            'client_phone2' => $this->faker->optional()->e164PhoneNumber(),
            'cod_to_pay' => $this->faker->randomFloat(2, 0, 5000),
            'commission' => $this->faker->randomFloat(2, 0, 200),
            'status_updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'delivered_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'delivery_price' => $this->faker->randomFloat(2, 100, 500),
            'extra_weight_price' => $this->faker->randomFloat(2, 0, 50),
            'free_delivery' => $this->faker->boolean,
            'packaging_price' => $this->faker->randomFloat(2, 0, 100),
            'partner_cod_price' => $this->faker->randomFloat(2, 0, 300),
            'partner_delivery_price' => $this->faker->randomFloat(2, 0, 100),
            'partner_return' => $this->faker->randomFloat(2, 0, 200),
            'price' => $this->faker->randomFloat(2, 100, 2000),
            'price_to_pay' => $this->faker->randomFloat(2, 50, 1500),
            'return_price' => $this->faker->randomFloat(2, 0, 100),
            'total_price' => $this->faker->randomFloat(2, 100, 3000),
            'weight' => $this->faker->numberBetween(500, 5000),
        ];
    }
}

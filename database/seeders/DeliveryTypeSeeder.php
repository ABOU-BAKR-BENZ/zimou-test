<?php

namespace Database\Seeders;

use App\Enums\DeliveryTypeEnum;
use App\Models\DeliveryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{

    protected $table = "delivery_types";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DeliveryType::insert(
            array_map(fn($status) => ['name' => $status], DeliveryTypeEnum::getValues())
        );
    }
}

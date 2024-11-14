<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreAndPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory(5000)->create()->each(function ($store) {
            $store->packages()->saveMany(Package::factory(100)->make());
        });
    }
}

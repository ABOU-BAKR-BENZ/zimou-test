<?php

namespace Database\Seeders;

use App\Enums\PackageStatusEnum;
use App\Models\PackageStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageStatusesSeeder extends Seeder
{

    protected $table = 'package_statuses';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageStatus::insert(
            array_map(fn($status) => ['name' => $status], PackageStatusEnum::getValues())
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Wilaya;
use ErrorException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WilayaAndCommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if tables exist
        if (! Schema::hasTable('wilayas') || ! Schema::hasTable('communes')) {
            Artisan::call('migrate');
        }

        $wilayas = Wilaya::count();
        $communes = Commune::count();

        if (! $wilayas && ! $communes) {
            $this->insertWilayas();
            $this->insertCommunes();
            return;
        }
    }

    protected function insertWilayas()
    {
        try {
            $wilayas_json = json_decode(file_get_contents(database_path('/seeders/json/wilayas.json')));
        } catch (ErrorException $e) {
            $wilayas_json = json_decode(file_get_contents(__DIR__ . '/wilayas.json'));
        }
        $data = [];
        foreach ($wilayas_json as $wilaya) {
            $data[] = [
                'name' => $wilaya->nom,
                'created_at' => now(),
            ];
        }
        Wilaya::insert($data);
    }

    protected function insertCommunes()
    {
        try {
            $communes_json = json_decode(file_get_contents(database_path('/seeders/json/communes.json')));
        } catch (ErrorException $e) {
            $communes_json = json_decode(file_get_contents(__DIR__ . '/json/communes.json'));
        }
        $data = [];
        foreach ($communes_json as $commune) {
            $data[] = [
                'name' => $commune->nom,
                'wilaya_id' => $commune->wilaya_id,
                'created_at' => now(),
            ];
        }
        Commune::insert($data);
    }
}

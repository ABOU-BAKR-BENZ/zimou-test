<?php

namespace App\Http\Controllers;

use App\Enums\DeliveryTypeEnum;
use App\Exports\PackagesExport;
use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Jobs\ExportPackageChunk;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Str;

class PackageController extends Controller
{

    public function performAction(Request $request)
    {

        $request->validate([
            'action' => 'required|string',
            'selected_packages' => 'required|array',
            'selected_packages.*' => 'integer|exists:packages,id',
        ]);
        $action = $request->input('action');
        $packageIds = array_map('intval', $request->input('selected_packages'));

        if ($action === 'export') {
            $packages = Package::whereIn('id', $packageIds)->get();
            $exportData = $packages->map(function ($package) {
                return [
                    'id' => $package->id,
                    'tracking_code' => $package->tracking_code,
                    'store_name' => $package->store->name,
                    'name' => $package->name,
                    'status_name' => $package->packageStatus->name,
                    'client_full_name' => $package->client_first_name . " " . $package->client_last_name,
                    'client_phone' => $package->client_phone,
                    'client_phone2' => $package->client_phone2,
                    'wilaya' => $package->commune->wilaya->name,
                    'commune' => $package->commune->name,
                    'delivery_type' => $package->deliveryType->name,
                ];
            });

            return Excel::download(new PackagesExport(packages: $exportData), 'packages.xlsx');
        } elseif ($action === 'delete') {
            $this->deletePackages($packageIds);
            return redirect()->route('packages.index')->with('message', 'Selected packages deleted successfully.');
        }
        return redirect()->back()->with('message', 'Excel File downloaded successfully.');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $packages = Package::paginate(50);
        return view('packages.index')->with('packages', $packages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $communes = json_decode(file_get_contents(base_path('database/seeders/json/communes.json')), true);
        $wilayas = json_decode(file_get_contents(base_path('database/seeders/json/wilayas.json')), true);
        return view('packages.create', [
            'communes' => $communes,
            'wilayas' => $wilayas,
            'deliveryTypes' => DeliveryType::all(),
            'stores' => Store::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePackageRequest $request)
    {

        $data = $request->validated();
        $data['uuid'] = uniqid('pkg_', true);

        $tracking_number = "";
        do {
            $suffix = '';
            for ($i = 0; $i < 6; $i++) {
                $suffix .= mt_rand(0, 1) ? mt_rand(0, 9) : chr(mt_rand(65, 90));
            }
            $tracking_number = 'ZMX-' . $suffix;
        } while (Package::where('tracking_code', $tracking_number)->exists());
        $data['tracking_code'] = $tracking_number;
        $data['status_id'] = PackageStatus::where('name', 'pending')->first()->id;
        $data['status_updated_at'] = now();
        $data['delivery_price'] = $this->getDeliveryPrice($request['wilaya_id']);

        if ($data['weight'] > 5000) {
            $data['extra_weight_price'] = ($data['weight'] - 5000) * 50;
        } else {
            $data['extra_weight_price'] = 0;
        }
        // Assuming the cost of packaging is 100 DA
        $data['packaging_price'] = 100;

        $data['partner_cod_price'] = ($data['cod_to_pay'] - $this->getDeliveryPrice($request['wilaya_id'])) * 0.025;

        $data['partner_delivery_price'] = $this->getDeliveryPrice($request['wilaya_id']) * 0.65;

        $data['partner_return'] = 120;
        $data['price'] = $data['cod_to_pay'] + $this->getDeliveryPrice($request['wilaya_id']);
        $data['price_to_pay'] = $data['cod_to_pay'];
        $data['return_price'] = 200;
        $data['total_price'] = $data['cod_to_pay'] + $this->getDeliveryPrice($request['wilaya_id']);

        Package::create($data);

        return redirect()->route('packages.index')->with("message", "Package has been created succefully.");
    }

    private function getDeliveryPrice($wilaya_id)
    {
        return [
            1200, // 1: Adrar
            600, // 2: Chlef
            1000, // 3: Laghouat
            800, // 4: Oum El Bouaghi
            800, // 5: Batna
            600, // 6: Béjaïa
            800, // 7: Biskra
            1000, // 8: Béchar
            600, // 9: Blida
            600, // 10: Bouira
            1000, // 11: Tamanrasset
            1000, // 12: Tébessa
            800, // 13: Tlemcen
            600, // 14: Tiaret
            600, // 15: Tizi Ouzou
            300, // 16: Alger (Algiers, central)
            600, // 17: Djelfa
            600, // 18: Jijel
            600, // 19: Sétif
            600, // 20: Saïda
            600, // 21: Skikda
            600, // 22: Sidi Bel Abbès
            800, // 23: Annaba
            800, // 24: Guelma
            600, // 25: Constantine
            600, // 26: Médéa
            600, // 27: Mostaganem
            450, // 28: M'Sila
            600, // 29: Mascara
            800, // 30: Ouargla
            600, // 31: Oran
            800, // 32: El Bayadh
            800, // 33: Illizi
            800, // 34: Bordj Bou Arréridj
            600, // 35: Boumerdès
            800, // 36: El Tarf
            800, // 37: Tindouf
            600, // 38: Tissemsilt
            400, // 39: El Oued
            800, // 40: Khenchela
            1000, // 41: Souk Ahras
            600, // 42: Tipaza
            800, // 43: Mila
            600, // 44: Aïn Defla
            1200, // 45: Naâma
            800, // 46: Aïn Témouchent
            1000, // 47: Ghardaïa
            800, // 48: Relizane
            1200, // 49: Timimoun
            1200, // 50: Bordj Badji Mokhtar
            1200, // 51: Ouled Djellal
            1200, // 52: Beni Abbes
            1200, // 53: In Salah
            1200, // 54: In Guezzam
            1200, // 55: Touggourt
            1200, // 56: Djanet
            1200, // 57: El M'Ghair
            1200, // 58: El Meniaa
        ][$wilaya_id];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $communes = json_decode(file_get_contents(base_path('database/seeders/json/communes.json')), true);
        $wilayas = json_decode(file_get_contents(base_path('database/seeders/json/wilayas.json')), true);
        return view('packages.edit', [
            'package' => $package,
            'communes' => $communes,
            'wilayas' => $wilayas,
            'deliveryTypes' => DeliveryType::all(),
            'stores' => Store::all(),
            'package_statuses' => PackageStatus::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->validated());
        $package->save();
        return redirect()->route('packages.index')->with("message", "Package has been updated succefully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
    }

    private function deletePackages(array $packageIds)
    {
        Package::whereIn('id', $packageIds)->delete();
    }

    public function trackingPage()
    {
        return view('packages.tracking');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string|exists:packages,tracking_code',
        ]);

        $trackingCode = $request->input('tracking_code');
        $trackingDetails = Package::where('tracking_code', $trackingCode)->first();

        if ($trackingDetails) {
            return view('packages.tracking', ['trackingDetails' => $trackingDetails]);
        } else {
            return back()->with('message', 'Package not found.');
        }
    }
}

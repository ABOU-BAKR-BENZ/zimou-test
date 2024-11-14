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

            Package::whereIn('id', $packageIds)->chunk(100, function ($chunk) {
                $fileName = 'packages_export_' . uniqid() . '.xlsx';
                ExportPackageChunk::dispatch($chunk, $fileName);
            });
        } elseif ($action === 'delete') {
            $this->deletePackages($packageIds);
        }
        return redirect()->back()->with('status', 'Action completed successfully.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::paginate(10000);
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
        $request['uuid'] = Str::uuid()->toString();

        $tracking_number = "";
        do {
            $suffix = '';
            for ($i = 0; $i < 6; $i++) {
                $suffix .= mt_rand(0, 1) ? mt_rand(0, 9) : chr(mt_rand(65, 90));
            }
            $tracking_number = 'ZMX-' . $suffix;
        } while (Package::where('tracking_code', $tracking_number)->exists());

        Package::create($request);

        return redirect()->route('packages.index');
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
        return redirect()->route('packages.index');
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
}

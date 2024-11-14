<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::paginate(50);
        return view('stores.index')->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStoreRequest $request)
    {
        $data = $request->validated();
        $data['code'] = 'store' . substr(uniqid(), 0, 5);;
        Store::create($data);
        return redirect()->route('stores.index')->with("message", "Store has been created succefully.");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        return view('stores.edit', ['store' => $store]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store->update($request->validated());
        $store->save();
        return redirect()->route('stores.index')->with("message", "Store has been updated succefully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $selectedStores = $request->input('selected_stores');

        if ($selectedStores) {
            Store::whereIn('id', $selectedStores)->delete();
            return redirect()->route('stores.index')->with('message', 'Selected stores deleted successfully.');
        }

        return redirect()->route('stores.index')->with('message', 'No stores selected for deletion.');
    }
}

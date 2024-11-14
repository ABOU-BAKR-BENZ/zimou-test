<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Packages') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-5xl text-center mb-4 mt-0 text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Updating Package') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('packages.update', $package) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Wilaya ID -->
                            <div class="mb-4">
                                <label for="wilaya" class="blockfont-bold text-xl text-white">Wilaya</label>
                                <select id="wilaya_id" name="wilaya_id"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select a Wilaya</option>
                                    @foreach ($wilayas as $wilaya)
                                        <option value="{{ $wilaya['id'] }}" class="bg-dark text-white"
                                            @selected($wilaya['id'] == $package->commune->wilaya->id)>
                                            {{ $wilaya['nom'] }}</option>
                                    @endforeach
                                </select>
                                @error('wilaya_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                                @error('wilaya')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Commune ID -->
                            <div class="mb-4">
                                <label for="commune_id" class="blockfont-bold text-xl text-white">Commune</label>
                                <select id="commune_id" name="commune_id"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select a Commune</option>
                                    @foreach ($communes as $commune)
                                        <option value="{{ $commune['id'] }}" class="bg-dark text-white"
                                            @selected($commune['id'] == $package->commune->id) data-wilaya-id="{{ $commune['wilaya_id'] }}">
                                            {{ $commune['nom'] }}</option>
                                    @endforeach
                                </select>
                                @error('commune_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- store ID -->
                            <div class="mb-4">
                                <label for="store_id" class="blockfont-bold text-xl text-white">store</label>
                                <select id="store_id" name="store_id"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select a store</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store['id'] }}" class="bg-dark text-white"
                                            @selected($store['id'] == $package->store_id)>
                                            {{ $store['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('commune_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Delivery Type ID -->
                            <div class="mb-4">
                                <label for="delivery_type_id" class="block font-bold text-xl text-white">Delivery
                                    Type</label>
                                <select id="delivery_type" name="delivery_type"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select delivery type</option>
                                    @foreach ($deliveryTypes as $type)
                                        <option value="{{ $type->id }}" class="bg-dark text-white"
                                            @selected($type->id == $package->delivery_type_id)>
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('delivery_type_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-4">
                                <label for="address" class="block font-bold text-xl text-white">Address</label>
                                <input type="text" id="address" name="address"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    value="{{ $package->address }}" placeholder="Enter delivery address" required>
                                @error('address')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="block font-bold text-xl text-white">Package
                                    Name</label>
                                <input type="text" id="name" name="name"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    value="{{ $package->name }}" placeholder="Enter package name" required>
                                @error('name')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Client First Name -->
                            <div class="mb-4">
                                <label for="client_first_name" class="block font-bold text-xl text-white">Client
                                    First Name</label>
                                <input type="text" id="client_first_name" name="client_first_name"
                                    placeholder="Enter client first name" value="{{ $package->client_first_name }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    required>
                                @error('client_first_name')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Client Last Name -->
                            <div class="mb-4">
                                <label for="client_last_name" class="block font-bold text-xl text-white">Client
                                    Last Name</label>
                                <input type="text" id="client_last_name" name="client_last_name"
                                    value="{{ $package->client_last_name }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    placeholder="Enter last name" required>
                                @error('client_last_name')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Client Phone -->
                            <div class="mb-4">
                                <label for="client_phone" class="block font-bold text-xl text-white">Client
                                    Phone</label>
                                <input type="text" id="client_phone" name="client_phone"
                                    value="{{ $package->client_phone }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    placeholder="Enter phone number" required>
                                @error('client_phone')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Client Phone 2 -->
                            <div class="mb-4">
                                <label for="client_phone2" class="block font-bold text-xl text-white">Client
                                    Phone 2</label>
                                <input type="text" id="client_phone2" name="client_phone2"
                                    value="{{ $package->client_phone2 }}"
                                    placeholder="Enter client second number (optional)"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900">
                                @error('client_phone2')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- COD To Pay -->
                            <div class="mb-4">
                                <label for="cod_to_pay" class="block font-bold text-xl text-white">COD To
                                    Pay</label>
                                <input type="text" id="cod_to_pay" name="cod_to_pay"
                                    value="{{ $package->cod_to_pay }}" placeholder="Enter COD To Pay"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    required>
                                @error('cod_to_pay')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Can Be Opened -->
                            <div class="mb-4">
                                <label for="can_be_opened" class="block font-bold text-xl text-white">Can Be
                                    Opened?</label>
                                <select id="can_be_opened" name="can_be_opened"
                                    class="mt-1 block w-full p-2 border rounded-md  text-white bg-gray-900" required>
                                    <option value="">Select a choice</option>
                                    <option value="1" @selected($package->can_be_opened == 1)>Yes</option>
                                    <option value="0" @selected($package->can_be_opened == 0)>No</option>

                                </select>
                                @error('can_be_opened')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Free Delivery -->
                            <div class="mb-4">
                                <label for="free_delivery" class="block font-bold text-xl text-white">Free
                                    Delivery</label>
                                <select id="free_delivery" name="free_delivery"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select a choice</option>
                                    <option value="1" @selected($package->free_delivery == 1)>Yes
                                    </option>
                                    <option value="0" @selected($package->free_delivery == 0)>No</option>
                                </select>
                                @error('free_delivery')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- weight -->
                            <div class="mb-4">
                                <label for="weight" class="block font-bold text-xl text-white"> Weight</label>
                                <input type="number" min="0" id="weight" name="weight"
                                    value="{{ $package->weight }}" placeholder="Enter package weight"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    required>
                                @error('weight')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="package_status" class="block font-bold text-xl text-white">Package
                                    Status</label>
                                <select id="package_status" name="package_status"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select a choice</option>
                                    @foreach ($package_statuses as $package_status)
                                        <option value="{{ $package_status->id }}" class="bg-dark text-white"
                                            @selected($package_status->id == $package->status_id)>
                                            {{ $package_status->name }}</option>
                                    @endforeach

                                </select>
                                @error('package_status')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <label for="delivred_at" class="block font-bold text-xl text-white">Package
                                    Delivred at</label>
                                <input type="datetime" id="delivred_at" name="delivred_at"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-900"
                                    value="{{ $package->delivered_at }}"
                                    placeholder="Enter delivery delivery time if package is delivre">
                                @error('delivred_at')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-bold text-xl text-white rounded-md bg-gray-900 hover:bg-blue-700">Update
                                    Package</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('wilaya_id').addEventListener('change', function() {
        let selectedWilayaId = this.value;
        let communeSelect = document.getElementById('commune_id');
        let communes = communeSelect.querySelectorAll('option');

        communes.forEach(function(commune) {
            commune.style.display = 'block';
        });

        communes.forEach(function(commune) {
            if (commune.getAttribute('data-wilaya-id') !== selectedWilayaId && selectedWilayaId !==
                '') {
                commune.style.display = 'none';
            }
        });
    });
</script>

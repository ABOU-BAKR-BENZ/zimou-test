<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Packages') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-5xl text-center mb-4 mt-0 text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Creating New Package') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('packages.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Wilaya ID -->
                            <div class="mb-4">
                                <label for="wilaya" class="blockfont-bold text-xl text-white">Wilaya</label>
                                <select id="wilaya_id" name="wilaya_id"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select a Wilaya</option>
                                    @foreach ($wilayas as $wilaya)
                                        <option value="{{ $wilaya['id'] }}" class="bg-dark text-white">
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
                                            data-wilaya-id="{{ $commune['wilaya_id'] }}">
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
                                        <option value="{{ $store['id'] }}" class="bg-dark text-white">
                                            {{ $store['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Delivery Type ID -->
                            <div class="mb-4">
                                <label for="delivery_type_id" class="block font-bold text-xl text-white">Delivery
                                    Type</label>
                                <select id="delivery_type_id" name="delivery_type_id"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Select delivery type</option>
                                    @foreach ($deliveryTypes as $type)
                                        <option value="{{ $type->id }}" class="bg-dark text-white">
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('delivery_type_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <x-form-input label="Address" name="address" type="text"
                                placeholder="Enter delivery address" :value="old('address')" error="address" />

                            {{-- Name --}}
                            <x-form-input label="Package Name" name="name" type="text"
                                placeholder="Enter package name" :value="old('name')" error="name" />

                            <!-- Client First Name -->
                            <x-form-input label="Client
                                    First Name"
                                name="client_first_name" type="text" placeholder="Enter client first name"
                                :value="old('client_first_name')" error="client_first_name" />

                            <!-- Client Last Name -->
                            <x-form-input label="Client
                                    Last Name"
                                name="client_last_name" type="text" placeholder="Enter client last name"
                                :value="old('client_last_name')" error="client_last_name" />

                            <!-- Client Phone -->
                            <x-form-input label="Client
                                    Phone 1" name="client_phone"
                                type="text" placeholder="Enter client phone" :value="old('client_phone')"
                                error="client_phone" />

                            <!-- Client Phone 2 -->
                            <x-form-input label="Client
                            Phone 2" name="client_phone2"
                                type="text" placeholder="Enter client phone 2" :value="old('client_phone2')"
                                error="client_phone2" />

                            <!-- COD To Pay -->
                            <x-form-input label="COD To
                                    Pay" name="cod_to_pay"
                                type="text" placeholder="Enter COD To Pay" :value="old('cod_to_pay')" error="cod_to_pay" />

                            <!-- Can Be Opened -->
                            <div class="mb-4">
                                <label for="can_be_opened" class="block font-bold text-xl text-white">Can Be
                                    Opened?</label>
                                <select id="can_be_opened" name="can_be_opened"
                                    class="mt-1 block w-full p-2 border rounded-md  text-white bg-gray-900" required>
                                    <option value="">Select a choice</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>

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
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>

                                </select>
                                @error('free_delivery')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- weight -->
                            <x-form-input label="Weight" name="weight" type="number"
                                placeholder="Enter package weight (g)" :value="old('weight')" error="weight" />

                            <div class="mb-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-bold text-xl text-white rounded-md bg-gray-900 hover:bg-blue-700">Create
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stores') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-5xl text-center mb-4 mt-0 text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Update Store') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('stores.update', $store) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- name -->
                            <x-form-input label="Store name" name="name" type="text"
                                placeholder="Enter store name" :value="$store->name" error="name" />

                            {{-- email --}}
                            <x-form-input label="Store Email" name="email" type="email"
                                placeholder="Enter store email" :value="$store->email" error="email" />

                            <!-- Store phone -->
                            <x-form-input label="Store phone" name="phones" type="text"
                                placeholder="Enter store phone" :value="$store->phones" error="phones" />

                            <!-- company Name -->
                            <x-form-input label="Company name" name="company_name" type="text"
                                placeholder="Enter company name" :value="$store->company_name" error="company_name" />

                            <!-- capital -->
                            <x-form-input label="Store Capital" name="capital" type="text"
                                placeholder="Enter store capital" :value="$store->capital" error="capital" />

                            <!-- Store address -->
                            <x-form-input label="Store Address" name="address" type="text"
                                placeholder="Enter store address" :value="$store->address" error="address" />

                            <!-- Register Commerce Number -->
                            <x-form-input label="Register Commerce Number" name="register_commerce_number"
                                type="text" placeholder="Enter register commerce number" :value="$store->register_commerce_number"
                                error="register_commerce_number" />

                            <!-- nif -->
                            <x-form-input label="NIF" name="nif" type="text" placeholder="Enter store NIF"
                                :value="$store->nif" error="nif" />


                            <!-- legal_form -->
                            <x-form-input label="Legal Form" name="legal_form" type="number"
                                placeholder="Enter legal form" :value="$store->legal_form" error="legal_form" />

                            <!-- Store Status -->
                            {{-- Store should be inactive when first created --}}
                            <div class="mb-4">
                                <label for="status" class="block font-bold text-xl text-white">Store
                                    Status</label>
                                <select id="status" name="status"
                                    class="mt-1 block w-full p-2 border rounded-md text-white bg-gray-900" required>
                                    <option value="">Store Status</option>
                                    <option value="1" @selected($store->status == 1)>Active</option>
                                    <option value="0" @selected($store->status == 0)>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-bold text-xl text-white rounded-md bg-gray-900 hover:bg-blue-700">Update
                                    Store</button>
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

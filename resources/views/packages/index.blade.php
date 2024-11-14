<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Packages') }}
            </h2>

            <a class="font-semibold text-xl text-gray-800 bg-blue-600 p-3 dark:text-gray-200 leading-tight"
                href="{{ route('packages.create') }}">
                {{ __('Create New Package') }}
            </a>
        </div>
    </x-slot>

    @if (session()->has('message'))
        <div class="alert alert-info fw-bold text-center fs-3" role="alert">
            <h3 class="bg-blue-500 text-white font-bold text-2xl">
                {{ session()->get('message') }}
            </h3>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="packageForm" action="{{ route('packages.action') }}" method="POST">
                        @csrf
                        <div class="flex mb-4">
                            <select id="actions" name="action"
                                class="mt-1 block w-80 p-2 border rounded-md text-white bg-gray-900" required
                                onchange="document.getElementById('packageForm').submit();">
                                <option value="">Select an action</option>
                                <option value="export">Export To Excel File</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                        <table class="min-w-full bg-gray-800 border border-black rounded-lg shadow-mdm">
                            <thead>
                                <tr class="text-white">
                                    <th class="px-1 py-4 text-center font-semibold"><input type="checkbox"
                                            name="selected_packages" value="-1" id="selectAll"></th>
                                    <th class="px-1 py-4 text-center font-semibold">Tracking Code</th>
                                    <th class="px-1 py-4 text-center font-semibold">Store Name</th>
                                    <th class="px-1 py-4 text-center font-semibold">Package Name</th>
                                    <th class="px-1 py-4 text-center font-semibold">Client Full Name</th>
                                    <th class="px-1 py-4 text-center font-semibold">Phone</th>
                                    <th class="px-1 py-4 text-center font-semibold">Wilaya</th>
                                    <th class="px-1 py-4 text-center font-semibold">Commune</th>
                                    <th class="px-1 py-4 text-center font-semibold">Delivery Type</th>
                                    <th class="px-1 py-4 text-center font-semibold">Status</th>
                                    <th class="px-1 py-4 text-center font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr class="border-t border-gray-200 hover:bg-gray-200 hover:text-gray-600">
                                        <th class="px-1 py-4 text-center font-semibold"><input type="checkbox"
                                                name="selected_packages[]" value="{{ +$package->id }}"
                                                class="package-checkbox"></th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $package->tracking_code }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $package->store->name }}</th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $package->name }}</th>
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">
                                            {{ $package->client_first_name . ' ' . $package->client_last_name }}</th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $package->client_phone }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">
                                            {{ $package->commune->wilaya->name }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $package->commune->name }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">
                                            {{ $package->deliveryType->name }}
                                        </th>
                                        @php
                                            $status = $package->packageStatus->name;
                                            $statusClasses = match ($status) {
                                                'pending' => 'bg-gray-200 text-gray-700',
                                                'in transit' => 'bg-blue-200 text-blue-800',
                                                'arrived at destination' => 'bg-green-200 text-green-700',
                                                'out for delivery' => 'bg-yellow-200 text-yellow-700',
                                                'delivered' => 'bg-green-500 text-white',
                                                'return to sender' => 'bg-red-200 text-red-700',
                                                'exception' => 'bg-red-500 text-white',
                                                'delayed' => 'bg-orange-200 text-orange-700',
                                                'lost' => 'bg-gray-500 text-white',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp

                                        <th class="px-1 py-4 text-center font-semibold {{ $statusClasses }}">
                                            {{ $status }}
                                        </th>
                                        <td class="px-1 py-4 text-sm flex justify-center">
                                            <a class="text-white py-3 px-3 bg-blue-700 rounded hover:bg-white hover:text-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                                href="{{ route('packages.edit', $package) }}">
                                                Edit
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <div class="mt-4">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.package-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Stores') }}
            </h2>

            <a class="font-semibold text-xl text-gray-800 bg-blue-600 p-3 dark:text-gray-200 leading-tight"
                href="{{ route('stores.create') }}">
                {{ __('Create New Store') }}
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
                    <form id="packageForm" action="{{ route('stores.destroy', ['stores' => 'selected_stores']) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="flex mb-4">
                            <select id="actions" name="action"
                                class="mt-1 block w-80 p-2 border rounded-md text-white bg-gray-900" required
                                onchange="document.getElementById('packageForm').submit();">
                                <option value="">Select an action</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                        <table class="min-w-full bg-gray-800 border border-black rounded-lg shadow-mdm">
                            <thead>
                                <tr class="text-white">
                                    <th class="px-1 py-4 text-center font-semibold"><input type="checkbox"
                                            name="selected_stores" value="-1" id="selectAll"></th>
                                    <th class="px-1 py-4 text-center font-semibold">Code</th>
                                    <th class="px-1 py-4 text-center font-semibold">Store Name</th>
                                    <th class="px-1 py-4 text-center font-semibold">Email</th>
                                    <th class="px-1 py-4 text-center font-semibold">Phone</th>
                                    <th class="px-1 py-4 text-center font-semibold">Company Name</th>
                                    <th class="px-1 py-4 text-center font-semibold">Capital</th>
                                    <th class="px-1 py-4 text-center font-semibold">Address</th>
                                    <th class="px-1 py-4 text-center font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr class="border-t border-gray-200 hover:bg-gray-200 hover:text-gray-600">
                                        <th class="px-1 py-4 text-center font-semibold"><input type="checkbox"
                                                name="selected_stores[]" value="{{ +$store->id }}"
                                                class="package-checkbox"></th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->code }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->name }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->email }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->phones }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->company_name }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->capital }}
                                        </th>
                                        <th class="px-1 py-4 text-center font-semibold">{{ $store->address }}
                                        </th>

                                        <td class="px-1 py-4 text-sm flex justify-center">
                                            <a class="text-white py-3 px-3 bg-blue-700 rounded hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                                href="{{ route('stores.edit', $store) }}">
                                                Edit
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <div class="mt-4">
                        {{ $stores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.package-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });
</script>

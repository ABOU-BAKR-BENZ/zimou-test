<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-200 leading-tight">
                {{ __('Packages') }}
            </h2>
            <h3 class="font-bold text-xl text-gray-600 dark:text-gray-300">
                {{ __('Track Your Package') }}
            </h3>
        </div>
    </x-slot>

    @if (session()->has('message'))
        <div class="flex justify-center mt-8">
            <div class="bg-blue-500 text-white font-bold rounded-lg shadow-lg w-3/4 md:w-1/2 p-4 text-center">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <!-- Tracking Form -->
                    <form action="{{ route('packages.track') }}" method="GET">
                        @csrf
                        <div class="flex items-center justify-center mb-8">
                            <input type="text" name="tracking_code" placeholder="Enter Tracking Code"
                                class="p-4 h-12 border border-gray-300 text-gray-800 rounded-l-lg w-2/3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 h-12 font-bold text-lg rounded-r-lg hover:bg-blue-700 transition ease-in-out duration-150">
                                Track
                            </button>
                        </div>
                    </form>

                    <!-- Displaying the current step as a card -->
                    @if (isset($trackingDetails))
                        <div class="bg-gray-50 dark:bg-gray-300 p-8 rounded-lg shadow-md mt-8 max-w-xl mx-auto">
                            <h3 class="text-2xl font-semibold text-center text-blue-700 mb-4">Current Tracking Step</h3>

                            <!-- Current step -->
                            <div
                                class="flex items-center justify-center bg-blue-100 dark:bg-gray-800 p-6 rounded-lg shadow-inner space-y-4">
                                <span class="text-6xl text-blue-700 mb-4">📦</span>
                                <div class="text-center">
                                    <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200 mb-1">
                                        <span class="text-blue-600">Status:</span>
                                        {{ $trackingDetails->packageStatus->name }}
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                                        <span class="text-blue-500 font-semibold">Last Updated:</span>
                                        {{ $trackingDetails->status_updated_at ? $trackingDetails->status_updated_at->format('Y-m-d H:i') : 'Unknown Date' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif(session()->has('message'))
                        <div class="mt-6 text-center">
                            <p class="text-blue-500 font-medium">{{ session()->get('message') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

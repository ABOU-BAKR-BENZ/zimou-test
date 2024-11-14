<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-gray-800 text-white max-w-7xl p-8 m-auto rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold">Welcome, {{ $user_name }}!</h2>
            <p class="mt-2 text-gray-400">Here’s an overview of your dashboard.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-8">

            <!-- Stores Card -->
            <div class="bg-purple-500 text-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $stores }}</h2>
                        <p>Total Stores</p>
                    </div>
                </div>
            </div>

            <!-- Total Packages Card -->
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V4a1 1 0 00-1-1h-6a1 1 0 00-1 1v5H4a1 1 0 00-1 1v6a1 1 0 001 1h10v5a1 1 0 001 1h6a1 1 0 001-1v-9h-5z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $packages_number }}</h2>
                        <p>Total Packages</p>
                    </div>
                </div>
            </div>

            <!-- Pending Packages Card -->
            <div class="bg-gray-600 text-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3M4 4l16 16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $pending_packages }}</h2>
                        <p>Pending Packages</p>
                    </div>
                </div>
            </div>


            <!-- Delivered Packages Card -->
            <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $delivered_packages }}</h2>
                        <p>Delivered Packages</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7l8-4 8 4v14l-8 4-8-4V7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $in_transit_packages }}</h2>
                        <p>In-Transit Packages</p>
                    </div>
                </div>
            </div>

            <!-- Returned Packages Card -->
            <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2 2m-2-2v6m0 4h.01M12 9a3 3 0 110-6 3 3 0 010 6zm-9 8a9 9 0 0118 0H3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $returned_packages }}</h2>
                        <p>Returned Packages</p>
                    </div>
                </div>
            </div>




        </div>

    </div>
</x-app-layout>

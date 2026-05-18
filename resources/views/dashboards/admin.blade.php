<x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Admin Dashboard
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="space-y-4">
            <p>Welcome, Admin.</p>

            <div class="flex gap-3">
            <a href="{{ route('admin.users.index') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Manage Users
            </a>

            <a href="{{ route('admin.clients.index') }}"
            class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Manage Clients
            </a>

            <a href="{{ route('admin.cases.index') }}"
            class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Manage Cases
            </a>

            <a href="{{ route('admin.search.index') }}"
        class="inline-block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
            Search
            </a>

            <a href="{{ route('admin.audit-logs.index') }}"
        class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Audit Logs
            </a>

                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Client Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Clients</h3>

                        <a href="{{ route('admin.clients.create') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Client
                        </a>
                    </div>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">IC / Passport No.</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Created At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $client->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $client->ic_passport_no ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $client->phone ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $client->email ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $client->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">
                                        No clients found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $clients->links()}}
                    </div> 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
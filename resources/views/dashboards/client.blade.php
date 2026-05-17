<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Client Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        My Cases
                    </h3>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Reference</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Assigned Lawyer</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Next Important Date</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Latest Update</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($cases as $case)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->case_reference }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->case_title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->case_status }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->assignedLawyer->name ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->next_important_date ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->latest_client_update ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">
                                        No cases found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
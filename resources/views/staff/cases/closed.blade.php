<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Closed / Archived Cases
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        Closed / Archived Assigned Cases
                    </h3>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Reference</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Client</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Lawyer</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Next Date</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($cases as $case)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->case_reference }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->case_title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->client->name ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->assignedLawyer->name ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->case_status }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $case->next_important_date ?? '-' }}</td>

                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('cases.show', $case) }}"
                                           class="text-blue-600 hover:underline">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">
                                        No closed or archived assigned cases found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('staff.dashboard') }}"
                           class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            Back to Dashboard
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
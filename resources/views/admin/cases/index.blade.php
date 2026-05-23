<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Case Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Cases</h3>

                        <a href="{{ route('admin.cases.create') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Case
                        </a>
                    </div>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Reference</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Client</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Lawyer</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Staff</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
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

                            <td class="border border-gray-300 px-4 py-2">
                                @forelse ($case->staff as $staffMember)
                                    <span>{{ $staffMember->name }}</span>@if (!$loop->last), @endif
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td class="border border-gray-300 px-4 py-2">{{ $case->case_type }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $case->case_status }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $case->next_important_date ?? '-' }}</td>

                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('admin.cases.show', $case) }}"
                                class="text-blue-600 hover:underline">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="border border-gray-300 px-4 py-2 text-center">
                                No cases found.
                            </td>
                        </tr>
                    @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $cases->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
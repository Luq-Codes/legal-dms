<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Assigned Cases & Documents
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">

                    <form method="GET" action="{{ route('search.index') }}">
                        <div class="flex gap-3">
                            <input type="text"
                                   name="query"
                                   value="{{ $query }}"
                                   placeholder="Search your assigned cases or documents..."
                                   class="w-full border-gray-300 rounded-md shadow-sm">

                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Search
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            @if ($query)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Case Results</h3>

                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Reference</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Client</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Lawyer</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
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
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('cases.show', $case) }}"
                                               class="text-blue-600 hover:underline">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">
                                            No assigned cases found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Document Results</h3>

                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Filename</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Case</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Client</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Uploaded By</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($documents as $document)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->document_title }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->original_filename }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->legalCase->case_reference ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->legalCase->client->name ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->document_status }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->uploader->name ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('cases.show', $document->legalCase) }}"
                                               class="text-blue-600 hover:underline">
                                                View Case
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">
                                            No assigned documents found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
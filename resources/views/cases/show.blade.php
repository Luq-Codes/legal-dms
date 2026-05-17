<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Case Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold">
                            {{ $case->case_title }}
                        </h3>

                        <p class="text-gray-600">
                            Reference: {{ $case->case_reference }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p><strong>Client:</strong> {{ $case->client->name ?? '-' }}</p>
                            <p><strong>Assigned Lawyer:</strong> {{ $case->assignedLawyer->name ?? '-' }}</p>
                            <p>
                                <strong>Assigned Staff:</strong>
                                @forelse ($case->staff as $staffMember)
                                    {{ $staffMember->name }}@if (!$loop->last), @endif
                                @empty
                                    -
                                @endforelse
                            </p>
                        </div>

                        <div>
                            <p><strong>Case Type:</strong> {{ $case->case_type }}</p>
                            <p><strong>Status:</strong> {{ $case->case_status }}</p>
                            <p><strong>Next Important Date:</strong> {{ $case->next_important_date ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Latest Client Update</h4>
                        <p class="border rounded p-3 bg-gray-50">
                            {{ $case->latest_client_update ?? '-' }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Internal Notes</h4>
                        <p class="border rounded p-3 bg-gray-50">
                            {{ $case->internal_notes ?? '-' }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-semibold text-lg">Documents</h4>

                            <a href="{{ route('documents.create', $case) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Upload Document
                            </a>
                        </div>

                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Original Filename</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Uploaded By</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Uploaded Date</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Notes</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($case->documents as $document)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->document_title }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->original_filename }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->document_status }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->uploader->name ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->created_at->format('d M Y') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $document->notes ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('documents.download', $document) }}"
                                               class="text-blue-600 hover:underline">
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">
                                            No documents uploaded yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('dashboard') }}"
                       class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Back to Dashboard
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
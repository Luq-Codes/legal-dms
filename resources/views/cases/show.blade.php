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

                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-lg">Documents</h4>

                        <div class="flex gap-2">
                            @if (
                                $case->case_status !== 'Closed' &&
                                auth()->user()->role === 'lawyer' &&
                                $case->assigned_lawyer_id === auth()->id()
                            )
                                <button type="button"
                                        onclick="document.getElementById('progressModal').classList.remove('hidden')"
                                        class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                                    Update Progress
                                </button>
                            @endif

                            @if ($case->case_status !== 'Closed')
                                <a href="{{ route('documents.create', $case) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Upload Document
                                </a>
                            @endif
                        </div>
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
                    <div id="progressModal"
                    class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">

                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Update Case Progress</h3>

                            <button type="button"
                                    onclick="document.getElementById('progressModal').classList.add('hidden')"
                                    class="text-gray-600 hover:text-gray-900">
                                ✕
                            </button>
                        </div>

                        <form method="POST" action="{{ route('cases.progress.update', $case) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="case_status" class="block font-medium text-sm text-gray-700">
                                    Case Status
                                </label>

                                <select name="case_status" id="case_status"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    @foreach (['Open', 'In Progress', 'Pending Hearing', 'Pending Client', 'Closed', 'Archived'] as $status)
                                        <option value="{{ $status }}" {{ old('case_status', $case->case_status) === $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('case_status')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="next_important_date" class="block font-medium text-sm text-gray-700">
                                    Next Important Date
                                </label>

                                <input type="date"
                                    name="next_important_date"
                                    id="next_important_date"
                                    value="{{ old('next_important_date', $case->next_important_date) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                                @error('next_important_date')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="latest_client_update" class="block font-medium text-sm text-gray-700">
                                    Latest Client Update
                                </label>

                                <textarea name="latest_client_update"
                                        id="latest_client_update"
                                        rows="3"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('latest_client_update', $case->latest_client_update) }}</textarea>

                                @error('latest_client_update')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="internal_notes" class="block font-medium text-sm text-gray-700">
                                    Internal Notes
                                </label>

                                <textarea name="internal_notes"
                                        id="internal_notes"
                                        rows="3"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('internal_notes', $case->internal_notes) }}</textarea>

                                @error('internal_notes')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-2">
                                <button type="button"
                                        onclick="document.getElementById('progressModal').classList.add('hidden')"
                                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                    Cancel
                                </button>

                                <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Save Progress
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                    @if (
                        $case->case_status !== 'Closed' &&
                        (
                            auth()->user()->role === 'admin' ||
                            (auth()->user()->role === 'lawyer' && $case->assigned_lawyer_id === auth()->id())
                        )
                    )
                        <form method="POST"
                            action="{{ route('cases.close', $case) }}"
                            class="inline-block"
                            onsubmit="return confirm('Are you sure you want to close this case?');">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Close This Case
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('dashboard') }}"
                        class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">
                            Back to Dashboard
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
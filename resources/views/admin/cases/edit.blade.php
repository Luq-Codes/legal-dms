<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Case
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.cases.update', $case) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="client_id" class="block font-medium text-sm text-gray-700">
                                Client
                            </label>

                            <select name="client_id" id="client_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ old('client_id', $case->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('client_id')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="assigned_lawyer_id" class="block font-medium text-sm text-gray-700">
                                Assigned Lawyer
                            </label>

                            <select name="assigned_lawyer_id" id="assigned_lawyer_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($lawyers as $lawyer)
                                    <option value="{{ $lawyer->id }}"
                                        {{ old('assigned_lawyer_id', $case->assigned_lawyer_id) == $lawyer->id ? 'selected' : '' }}>
                                        {{ $lawyer->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('assigned_lawyer_id')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="staff_ids" class="block font-medium text-sm text-gray-700">
                                Assigned Staff
                            </label>

                            <select name="staff_ids[]" id="staff_ids"
                                    multiple
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($staff as $staffMember)
                                    <option value="{{ $staffMember->id }}"
                                        {{ collect(old('staff_ids', $case->staff->pluck('id')->toArray()))->contains($staffMember->id) ? 'selected' : '' }}>
                                        {{ $staffMember->name }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="text-sm text-gray-500 mt-1">
                                Hold Ctrl to select multiple staff members.
                            </p>

                            @error('staff_ids')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="case_title" class="block font-medium text-sm text-gray-700">
                                Case Title
                            </label>

                            <input type="text" name="case_title" id="case_title"
                                   value="{{ old('case_title', $case->case_title) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('case_title')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="case_reference" class="block font-medium text-sm text-gray-700">
                                Case Reference
                            </label>

                            <input type="text" name="case_reference" id="case_reference"
                                   value="{{ old('case_reference', $case->case_reference) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('case_reference')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="case_type" class="block font-medium text-sm text-gray-700">
                                Case Type
                            </label>

                            <select name="case_type" id="case_type"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach (['Civil', 'Criminal', 'Family', 'Corporate', 'Conveyancing', 'Litigation', 'Other'] as $type)
                                    <option value="{{ $type }}" {{ old('case_type', $case->case_type) === $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>

                            @error('case_type')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

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

                            <input type="date" name="next_important_date" id="next_important_date"
                                   value="{{ old('next_important_date', $case->next_important_date) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('next_important_date')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="opened_date" class="block font-medium text-sm text-gray-700">
                                Opened Date
                            </label>

                            <input type="date" name="opened_date" id="opened_date"
                                   value="{{ old('opened_date', $case->opened_date) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('opened_date')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="closed_date" class="block font-medium text-sm text-gray-700">
                                Closed Date
                            </label>

                            <input type="date" name="closed_date" id="closed_date"
                                   value="{{ old('closed_date', $case->closed_date) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('closed_date')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="latest_client_update" class="block font-medium text-sm text-gray-700">
                                Latest Client Update
                            </label>

                            <textarea name="latest_client_update" id="latest_client_update"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                      rows="3">{{ old('latest_client_update', $case->latest_client_update) }}</textarea>

                            @error('latest_client_update')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="internal_notes" class="block font-medium text-sm text-gray-700">
                                Internal Notes
                            </label>

                            <textarea name="internal_notes" id="internal_notes"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                      rows="3">{{ old('internal_notes', $case->internal_notes) }}</textarea>

                            @error('internal_notes')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="archive_location" class="block font-medium text-sm text-gray-700">
                                Archive Location
                            </label>

                            <input type="text" name="archive_location" id="archive_location"
                                   value="{{ old('archive_location', $case->archive_location) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('archive_location')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update Case
                        </button>

                        <a href="{{ route('admin.cases.show', $case) }}" class="ml-2 text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
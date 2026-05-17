<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Case
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.cases.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="client_id" class="block font-medium text-sm text-gray-700">
                                Client
                            </label>

                            <select name="client_id" id="client_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Select client</option>

                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
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
                                <option value="">Select lawyer</option>

                                @foreach ($lawyers as $lawyer)
                                    <option value="{{ $lawyer->id }}" {{ old('assigned_lawyer_id') == $lawyer->id ? 'selected' : '' }}>
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
                                        {{ collect(old('staff_ids'))->contains($staffMember->id) ? 'selected' : '' }}>
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
                                   value="{{ old('case_title') }}"
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
                                   value="{{ old('case_reference') }}"
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
                                <option value="">Select case type</option>
                                <option value="Civil" {{ old('case_type') === 'Civil' ? 'selected' : '' }}>Civil</option>
                                <option value="Criminal" {{ old('case_type') === 'Criminal' ? 'selected' : '' }}>Criminal</option>
                                <option value="Family" {{ old('case_type') === 'Family' ? 'selected' : '' }}>Family</option>
                                <option value="Corporate" {{ old('case_type') === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                                <option value="Conveyancing" {{ old('case_type') === 'Conveyancing' ? 'selected' : '' }}>Conveyancing</option>
                                <option value="Litigation" {{ old('case_type') === 'Litigation' ? 'selected' : '' }}>Litigation</option>
                                <option value="Other" {{ old('case_type') === 'Other' ? 'selected' : '' }}>Other</option>
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
                                <option value="Open" {{ old('case_status') === 'Open' ? 'selected' : '' }}>Open</option>
                                <option value="In Progress" {{ old('case_status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Pending Hearing" {{ old('case_status') === 'Pending Hearing' ? 'selected' : '' }}>Pending Hearing</option>
                                <option value="Pending Client" {{ old('case_status') === 'Pending Client' ? 'selected' : '' }}>Pending Client</option>
                                <option value="Closed" {{ old('case_status') === 'Closed' ? 'selected' : '' }}>Closed</option>
                                <option value="Archived" {{ old('case_status') === 'Archived' ? 'selected' : '' }}>Archived</option>
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
                                   value="{{ old('next_important_date') }}"
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
                                   value="{{ old('opened_date') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('opened_date')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="latest_client_update" class="block font-medium text-sm text-gray-700">
                                Latest Client Update
                            </label>
                            <textarea name="latest_client_update" id="latest_client_update"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                      rows="3">{{ old('latest_client_update') }}</textarea>

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
                                      rows="3">{{ old('internal_notes') }}</textarea>

                            @error('internal_notes')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Case
                        </button>

                        <a href="{{ route('admin.cases.index') }}" class="ml-2 text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
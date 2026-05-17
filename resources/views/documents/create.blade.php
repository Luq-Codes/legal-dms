<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Document
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">
                            Case: {{ $case->case_title }}
                        </h3>
                        <p class="text-gray-600">
                            Reference: {{ $case->case_reference }}
                        </p>
                    </div>

                    <form method="POST"
                          action="{{ route('documents.store', $case) }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="document_title" class="block font-medium text-sm text-gray-700">
                                Document Title
                            </label>
                            <input type="text" name="document_title" id="document_title"
                                   value="{{ old('document_title') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('document_title')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="document_status" class="block font-medium text-sm text-gray-700">
                                Document Status
                            </label>

                            <select name="document_status" id="document_status"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Draft" {{ old('document_status') === 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Under Review" {{ old('document_status') === 'Under Review' ? 'selected' : '' }}>Under Review</option>
                                <option value="Final" {{ old('document_status') === 'Final' ? 'selected' : '' }}>Final</option>
                                <option value="Signed" {{ old('document_status') === 'Signed' ? 'selected' : '' }}>Signed</option>
                                <option value="Archived" {{ old('document_status') === 'Archived' ? 'selected' : '' }}>Archived</option>
                            </select>

                            @error('document_status')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="file" class="block font-medium text-sm text-gray-700">
                                File
                            </label>
                            <input type="file" name="file" id="file"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('file')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block font-medium text-sm text-gray-700">
                                Notes
                            </label>
                            <textarea name="notes" id="notes"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                      rows="4">{{ old('notes') }}</textarea>

                            @error('notes')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Upload Document
                        </button>

                        <a href="{{ route('cases.show', $case) }}" class="ml-2 text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
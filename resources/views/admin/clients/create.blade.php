<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Client
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.clients.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="user_id" class="block font-medium text-sm text-gray-700">
                                Linked Client Login Account
                            </label>

                            <select name="user_id" id="user_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">No linked account</option>

                                @foreach ($clientUsers as $clientUser)
                                    <option value="{{ $clientUser->id }}" {{ old('user_id') == $clientUser->id ? 'selected' : '' }}>
                                        {{ $clientUser->name }} ({{ $clientUser->email }})
                                    </option>
                                @endforeach
                            </select>

                            @error('user_id')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">
                                Name
                            </label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('name')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="ic_passport_no" class="block font-medium text-sm text-gray-700">
                                IC / Passport No.
                            </label>
                            <input type="text" name="ic_passport_no" id="ic_passport_no"
                                   value="{{ old('ic_passport_no') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('ic_passport_no')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block font-medium text-sm text-gray-700">
                                Phone
                            </label>
                            <input type="text" name="phone" id="phone"
                                   value="{{ old('phone') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('phone')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('email')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block font-medium text-sm text-gray-700">
                                Address
                            </label>
                            <textarea name="address" id="address"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                      rows="4">{{ old('address') }}</textarea>

                            @error('address')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Client
                        </button>

                        <a href="{{ route('admin.clients.index') }}" class="ml-2 text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
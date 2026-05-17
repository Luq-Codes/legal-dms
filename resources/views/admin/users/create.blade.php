<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

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
                            <label for="password" class="block font-medium text-sm text-gray-700">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('password')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">
                                Role
                            </label>

                            <select name="role" id="role"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="lawyer" {{ old('role') === 'lawyer' ? 'selected' : '' }}>Lawyer</option>
                                <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                            </select>

                            @error('role')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create User
                        </button>

                        <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
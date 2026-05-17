<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User Role
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        {{ $user->name }}
                    </h3>

                    <p class="mb-4">
                        Email: {{ $user->email }}
                    </p>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">
                                Role
                            </label>

                            <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="lawyer" {{ $user->role === 'lawyer' ? 'selected' : '' }}>Lawyer</option>
                                <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                            </select>

                            @error('role')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update Role
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
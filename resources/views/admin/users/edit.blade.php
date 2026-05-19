<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">
                                Name
                            </label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('name')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('email')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">
                                Role
                            </label>

                            <select name="role"
                                    id="role"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="lawyer" {{ old('role', $user->role) === 'lawyer' ? 'selected' : '' }}>Lawyer</option>
                                <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Client</option>
                            </select>

                            @error('role')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-6">

                        <h3 class="text-lg font-semibold mb-2">
                            Reset Password
                        </h3>

                        <p class="text-sm text-gray-600 mb-4">
                            Leave the password fields empty if you do not want to change this user's password.
                        </p>

                        <div class="mb-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">
                                New Password
                            </label>

                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            @error('password')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                                Confirm New Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update User
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
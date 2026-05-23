<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Audit Logs
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">System Activity</h3>
                   
                    <div class="flex gap-2 mb-4">
                        <a href="{{ route('admin.audit-logs.index') }}"
                        class="px-4 py-2 rounded {{ !$module ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            All
                        </a>

                        @foreach ($modules as $moduleName)
                            <a href="{{ route('admin.audit-logs.index', ['module' => $moduleName]) }}"
                            class="px-4 py-2 rounded {{ $module === $moduleName ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                {{ $moduleName }}
                            </a>
                        @endforeach
                    </div>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Date / Time</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">User</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Module</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">IP Address</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->created_at->format('d M Y, h:i A') }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->user->name ?? 'System / Deleted User' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->action }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->module ?? '-' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->description ?? '-' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->ip_address ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">
                                        No audit logs found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $logs->appends(request()->query())->links() }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            Back to Dashboard
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
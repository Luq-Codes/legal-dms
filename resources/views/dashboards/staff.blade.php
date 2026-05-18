<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Staff Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        Case Folders
                    </h3>

                    <div class="flex gap-3">
                        <a href="{{ route('staff.cases.active') }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Active Cases
                        </a>

                        <a href="{{ route('staff.cases.closed') }}"
                           class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            Closed / Archived Cases
                        </a>

                        <a href="{{ route('search.index') }}"
                            class="inline-block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                                Search
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
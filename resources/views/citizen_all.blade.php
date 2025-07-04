{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_all.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Registered Citizens') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <div class="mb-4">
                    <a href="{{ route('citizens.export.excel') }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs">Export Excel</a>
                    <a href="{{ route('citizens.export.pdf') }}" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">Export PDF</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 max-w-[80px] break-words">Citizen ID</th>
                                <th class="px-4 py-2 max-w-[100px] break-words">First Name</th>
                                <th class="px-4 py-2 max-w-[100px] break-words">Surname</th>
                                <th class="px-4 py-2 max-w-[80px] break-words">Gender</th>
                                <th class="px-4 py-2 max-w-[120px] break-words">NIN</th>
                                <th class="px-4 py-2 max-w-[100px] break-words">Hometown</th>
                                <th class="px-4 py-2 max-w-[100px] break-words">Date of Birth</th>
                                <th class="px-4 py-2 max-w-[120px] break-words">Address</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citizens as $citizen)
                            <tr>
                                <td class="px-4 py-2 max-w-[80px] break-words">{{ $citizen->citizen_id }}</td>
                                <td class="px-4 py-2 max-w-[100px] break-words">{{ $citizen->first_name }}</td>
                                <td class="px-4 py-2 max-w-[100px] break-words">{{ $citizen->surname }}</td>
                                <td class="px-4 py-2 max-w-[80px] break-words">{{ $citizen->gender }}</td>
                                <td class="px-4 py-2 max-w-[120px] break-words">{{ $citizen->nin }}</td>
                                <td class="px-4 py-2 max-w-[100px] break-words">{{ $citizen->hometown }}</td>
                                <td class="px-4 py-2 max-w-[100px] break-words">{{ $citizen->date_of_birth }}</td>
                                <td class="px-4 py-2 max-w-[120px] break-words truncate" title="{{ $citizen->address }}">{{ $citizen->address }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('citizen.printId', $citizen->id) }}" target="_blank" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 text-xs">Print ID</a>
                                    <a href="{{ route('citizen.edit', $citizen->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-xs">Edit</a>
                                    <form action="{{ route('citizen.destroy', $citizen->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this citizen?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Pagination links --}}
                <div class="mt-4">
                    {{ $citizens->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_search_results.blade.php --}}

<x-app-layout>
    <div class="container mx-auto mt-10 max-w-4xl bg-white shadow-md rounded-lg p-6">
        <div class="mb-4 flex gap-2">
            <a href="{{ route('citizens.export.excel', request()->query()) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs">Export Excel</a>
            <a href="{{ route('citizens.export.pdf', request()->query()) }}" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">Export PDF</a>
        </div>
        @if(isset($citizens) && $citizens instanceof \Illuminate\Pagination\LengthAwarePaginator && $citizens->count())
            <div class="overflow-x-auto">
                <table class="divide-y divide-gray-200 w-full">
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
                            <td class="px-4 py-2 max-w-[120px] break-words">{{ $citizen->address }}</td>
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
            <div class="mt-4">
                {{ $citizens->links() }}
            </div>
        @else
            <div class="text-center text-gray-500">No results found.</div>
        @endif
    </div>
</x-app-layout>
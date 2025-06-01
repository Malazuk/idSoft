{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_search_results.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-4xl bg-white shadow-md rounded-lg p-6">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-5 text-center text-gray-800">Search Results</h1>
        @if($citizens->isEmpty())
            <p class="text-center text-gray-700">No citizens found matching your criteria.</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Citizen ID</th>
                        <th class="border border-gray-300 px-4 py-2">First Name</th>
                        <th class="border border-gray-300 px-4 py-2">Surname</th>
                        <th class="border border-gray-300 px-4 py-2">Hometown</th>
                        <th class="border border-gray-300 px-4 py-2">Date of Birth</th>
                        <th class="border border-gray-300 px-4 py-2">Address</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citizens as $citizen)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $citizen->citizen_id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $citizen->first_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $citizen->surname }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $citizen->hometown }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $citizen->date_of_birth }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $citizen->address }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('citizen.printId', $citizen->id) }}" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Print ID
                                </a>
                                <a href="{{ route('citizen.edit', $citizen->id) }}" 
                                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('citizen.destroy', $citizen->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="first_name" value="{{ request('first_name') }}">
                                    <input type="hidden" name="surname" value="{{ request('surname') }}">
                                    <input type="hidden" name="citizen_id" value="{{ request('citizen_id') }}">
                                    <input type="hidden" name="hometown" value="{{ request('hometown') }}">
                                    <input type="hidden" name="date_of_birth" value="{{ request('date_of_birth') }}">
                                    <input type="hidden" name="address" value="{{ request('address') }}">
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition"
                                            onclick="return confirm('Are you sure you want to delete this citizen?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
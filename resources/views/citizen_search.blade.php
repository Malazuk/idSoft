{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_search.blade.php --}}

<x-app-layout>
    <div class="container mx-auto mt-10 max-w-4xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-5 text-center text-gray-800">Search Citizens</h1>
        <form action="{{ route('citizen.search') }}" method="GET" class="space-y-4">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" name="surname" id="surname" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="citizen_id" class="block text-sm font-medium text-gray-700">Citizen ID</label>
                <input type="text" name="citizen_id" id="citizen_id" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="hometown" class="block text-sm font-medium text-gray-700">Hometown</label>
                <input type="text" name="hometown" id="hometown" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            {{-- Gender --}}
            <div class="mb-4">
                <label for="gender" class="block text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">Any</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- NIN --}}
            <div class="mb-4">
                <label for="nin" class="block text-gray-700">National Identification Number (NIN)</label>
                <input type="text" name="nin" id="nin" value="{{ old('nin') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Search</button>
        </form>
    </div>
</x-app-layout>
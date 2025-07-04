{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_edit.blade.php --}}

<x-app-layout>
    <div class="container mx-auto mt-10 max-w-3xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-5 text-center text-gray-800">Edit Citizen Information</h1>
        <form action="{{ route('citizen.update', $citizen->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="first_name" value="{{ request('first_name') }}">
            <input type="hidden" name="surname" value="{{ request('surname') }}">
            <input type="hidden" name="citizen_id" value="{{ request('citizen_id') }}">
            <input type="hidden" name="hometown" value="{{ request('hometown') }}">
            <input type="hidden" name="date_of_birth" value="{{ request('date_of_birth') }}">
            <input type="hidden" name="address" value="{{ request('address') }}">
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $citizen->first_name }}" 
                       class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" name="surname" id="surname" value="{{ $citizen->surname }}" 
                       class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="other_names" class="block text-sm font-medium text-gray-700">Other Names</label>
                <input type="text" name="other_names" id="other_names" value="{{ $citizen->other_names }}" 
                       class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="hometown" class="block text-sm font-medium text-gray-700">Hometown</label>
                <input type="text" name="hometown" id="hometown" value="{{ $citizen->hometown }}" 
                       class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $citizen->date_of_birth }}" 
                       class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" 
                          class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $citizen->address }}</textarea>
            </div>
            <div class="mb-4">
                <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Info</label>
                <input type="text" name="contact_info" id="contact_info" value="{{ $citizen->contact_info }}" 
                       class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            {{-- Gender --}}
            <div class="mb-4">
                <label for="gender" class="block text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $citizen->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $citizen->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $citizen->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- NIN --}}
            <div class="mb-4">
                <label for="nin" class="block text-gray-700">National Identification Number (NIN)</label>
                <input type="text" name="nin" id="nin" value="{{ old('nin', $citizen->nin) }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update</button>
        </form>
    </div>
    
</x-app-layout>
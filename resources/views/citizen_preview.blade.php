{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_preview.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Citizen Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-3xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-5 text-center text-gray-800">Preview Citizen Information</h1>
        <form action="{{ route('citizen.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">First Name:</label>
                <p class="text-gray-800">{{ $data['first_name'] }}</p>
                <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Surname:</label>
                <p class="text-gray-800">{{ $data['surname'] }}</p>
                <input type="hidden" name="surname" value="{{ $data['surname'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Other Names:</label>
                <p class="text-gray-800">{{ $data['other_names'] }}</p>
                <input type="hidden" name="other_names" value="{{ $data['other_names'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Hometown:</label>
                <p class="text-gray-800">{{ $data['hometown'] }}</p>
                <input type="hidden" name="hometown" value="{{ $data['hometown'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Date of Birth:</label>
                <p class="text-gray-800">{{ $data['date_of_birth'] }}</p>
                <input type="hidden" name="date_of_birth" value="{{ $data['date_of_birth'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address:</label>
                <p class="text-gray-800">{{ $data['address'] }}</p>
                <input type="hidden" name="address" value="{{ $data['address'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Contact Info:</label>
                <p class="text-gray-800">{{ $data['contact_info'] }}</p>
                <input type="hidden" name="contact_info" value="{{ $data['contact_info'] }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Photo:</label>
                <img src="{{ asset('storage/' . $photoPath) }}" alt="Uploaded Photo" class="w-32 h-32 rounded border">
                <input type="hidden" name="photo_path" value="{{ $photoPath }}">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Submit</button>
        </form>
    </div>
</body>
</html>
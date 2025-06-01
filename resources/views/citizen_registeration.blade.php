{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_registration.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-3xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-5 text-center text-gray-800">Citizen Registration Form</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('citizen.preview') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" name="surname" id="surname" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="other_names" class="block text-sm font-medium text-gray-700">Other Names</label>
                <input type="text" name="other_names" id="other_names" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="hometown" class="block text-sm font-medium text-gray-700">Hometown</label>
                <input type="text" name="hometown" id="hometown" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="mb-4">
                <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Info</label>
                <input type="text" name="contact_info" id="contact_info" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Upload Photo</label>
                <input type="file" name="photo" id="photo" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Preview</button>
        </form>
    </div>
</body>
</html>
{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_id_card.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen ID Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('storage/' . $citizen->photo_path) }}" alt="Citizen Photo" class="w-32 h-32 rounded-full border">
        </div>
        <h1 class="text-xl font-bold text-center text-gray-800 mb-4">Citizen ID Card</h1>
        <div class="text-gray-700">
            <p><strong>Citizen ID:</strong> {{ $citizen->citizen_id }}</p>
            <p><strong>First Name:</strong> {{ $citizen->first_name }}</p>
            <p><strong>Surname:</strong> {{ $citizen->surname }}</p>
            <p><strong>Other Names:</strong> {{ $citizen->other_names }}</p>
            <p><strong>Hometown:</strong> {{ $citizen->hometown }}</p>
            <p><strong>Date of Birth:</strong> {{ $citizen->date_of_birth }}</p>
            <p><strong>Address:</strong> {{ $citizen->address }}</p>
        </div>
        <div class="mt-6 text-center">
            <button onclick="window.print()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Print ID Card</button>
        </div>
    </div>
</body>
</html>
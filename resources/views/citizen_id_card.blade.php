{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_id_card.blade.php --}}

<x-app-layout>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div id="id-card" class="bg-white shadow-lg rounded-lg p-6 w-96 print-id-card">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $citizen->photo_path) }}" alt="Citizen Photo" class="w-32 h-32 rounded-full border">
            </div>
            <h1 class="text-xl font-bold text-center text-gray-800 mb-4">Citizen ID Card</h1>
            <div class="text-gray-700 text-sm">
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
    </div>
    <style>
        @media print {
            body * {
                visibility: hidden !important;
            }
            #id-card, #id-card * {
                visibility: visible !important;
            }
            #id-card {
                position: absolute;
                left: 0;
                top: 0;
                /* Standard ID card size: 85.6mm x 54mm */
                width: 85.6mm !important;
                height: 54mm !important;
                margin: 10%;
                box-shadow: none !important;
                background: #fff !important;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                page-break-after: avoid;
            }
            #id-card button {
                display: none !important;
            }
            /* Remove padding for print */
            #id-card {
                padding: 0 !important;
            }
            /* Center the card on the page */
            html, body {
                height: 100%;
                width: 100%;
            }
            body {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</x-app-layout>
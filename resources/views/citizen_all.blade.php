{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_all.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Registered Citizens') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Citizen ID</th>
                            <th class="px-4 py-2">First Name</th>
                            <th class="px-4 py-2">Surname</th>
                            <th class="px-4 py-2">Hometown</th>
                            <th class="px-4 py-2">Date of Birth</th>
                            <th class="px-4 py-2">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($citizens as $citizen)
                        <tr>
                            <td class="px-4 py-2">{{ $citizen->citizen_id }}</td>
                            <td class="px-4 py-2">{{ $citizen->first_name }}</td>
                            <td class="px-4 py-2">{{ $citizen->surname }}</td>
                            <td class="px-4 py-2">{{ $citizen->hometown }}</td>
                            <td class="px-4 py-2">{{ $citizen->date_of_birth }}</td>
                            <td class="px-4 py-2">{{ $citizen->address }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
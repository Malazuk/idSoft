<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ $totalCitizens }}</div>
                    <div class="text-gray-500">Total Citizens</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ $newThisMonth }}</div>
                    <div class="text-gray-500">New This Month</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ $admins }}</div>
                    <div class="text-gray-500">Admins</div>
                </div>
            </div>
            {{-- Chart --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow mb-8">
                <h3 class="text-lg font-semibold mb-4">Citizens Registered Per Month</h3>
                <div class="relative w-full" style="height:300px;">
                    <canvas id="citizensChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('citizensChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Registrations',
                    data: {!! json_encode($registrations) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-500 text-white rounded-lg shadow p-6 flex flex-col items-center">
                    <div class="text-3xl font-bold">{{ $totalCitizens }}</div>
                    <div class="mt-2 text-lg">Total Citizens Registered</div>
                </div>
                <div class="bg-green-500 text-white rounded-lg shadow p-6 flex flex-col items-center">
                    <div class="text-3xl font-bold">{{ $newThisMonth }}</div>
                    <div class="mt-2 text-lg">Registered This Month</div>
                </div>
            </div>
            {{-- Charts --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <div class="flex flex-wrap gap-8 justify-center">
                    {{-- Bar Chart --}}
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-center">Citizens per Hometown</h3>
                        <canvas id="barChart" width="400" height="300"></canvas>
                    </div>
                    {{-- Pie Chart --}}
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-center">Gender Distribution</h3>
                        <canvas id="genderPieChart" width="300" height="300"></canvas>
                        <div class="mt-2 text-sm text-center">
                            <span class="mr-4">Male: {{ $maleCount }}</span>
                            <span class="mr-4">Female: {{ $femaleCount }}</span>
                            <span>Other: {{ $otherCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-10">
                    <h3 class="text-lg font-semibold mb-2 text-center">Monthly Registrations by Gender</h3>
                    <canvas id="dualBarChart" width="600" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar Chart Data (example: citizens per hometown)
        const barLabels = {!! json_encode($hometownLabels) !!};
        const barData = {!! json_encode($hometownCounts) !!};

        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Number of Citizens',
                    data: barData,
                    backgroundColor: '#36A2EB',
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { title: { display: true, text: 'Hometown' } },
                    y: { title: { display: true, text: 'Citizens' }, beginAtZero: true }
                }
            }
        });

        // Pie Chart Data (gender distribution)
        const genderPieCtx = document.getElementById('genderPieChart').getContext('2d');
        new Chart(genderPieCtx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female', 'Other'],
                datasets: [{
                    data: [{{ $maleCount }}, {{ $femaleCount }}, {{ $otherCount }}],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Dual Bar Chart: Monthly Registrations by Gender
        const dualBarCtx = document.getElementById('dualBarChart').getContext('2d');
        new Chart(dualBarCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [
                    {
                        label: 'Male',
                        data: {!! json_encode($maleRegistrations) !!},
                        backgroundColor: '#36A2EB'
                    },
                    {
                        label: 'Female',
                        data: {!! json_encode($femaleRegistrations) !!},
                        backgroundColor: '#FF6384'
                    }
                ]
            },
            options: {
                responsive: false,
                plugins: { legend: { position: 'top' } },
                scales: {
                    x: { title: { display: true, text: 'Month' }, stacked: false },
                    y: { title: { display: true, text: 'Registrations' }, beginAtZero: true, stacked: false }
                }
            }
        });
    </script>
</x-app-layout>

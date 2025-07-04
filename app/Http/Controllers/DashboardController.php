<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats
        $totalCitizens = Citizen::count();
        $newThisMonth = Citizen::whereMonth('created_at', Carbon::now()->month)->count();
        $admins = \App\Models\User::where('role', 'admin')->count();

        // Chart Data: Citizens registered per month (last 6 months)
        $months = [];
        $registrations = [];
        $maleRegistrations = [];
        $femaleRegistrations = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M Y');
            $registrations[] = Citizen::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $maleRegistrations[] = Citizen::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->where('gender', 'Male')
                ->count();
            $femaleRegistrations[] = Citizen::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->where('gender', 'Female')
                ->count();
        }

        $maleCount = Citizen::where('gender', 'Male')->count();
        $femaleCount = Citizen::where('gender', 'Female')->count();
        $otherCount = Citizen::where('gender', 'Other')->count();

        // Top 5 hometowns by citizen count
        $hometownData = Citizen::select('hometown')
            ->selectRaw('count(*) as count')
            ->groupBy('hometown')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $hometownLabels = $hometownData->pluck('hometown');
        $hometownCounts = $hometownData->pluck('count');

        return view('dashboard', compact(
            'totalCitizens',
            'newThisMonth',
            'admins',
            'months',
            'registrations',
            'maleCount',
            'femaleCount',
            'otherCount',
            'hometownLabels',
            'hometownCounts',
            'maleRegistrations',
            'femaleRegistrations'
        ));
    }
}

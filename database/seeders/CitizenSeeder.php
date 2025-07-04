<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Citizen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the directory exists
        Storage::disk('public')->makeDirectory('citizen_photos');

        // We'll use pravatar.cc images (1-70)
        $avatarMax = 70;

        // Create 2000 citizens
        Citizen::factory()
            ->count(2000)
            ->make()
            ->each(function ($citizen, $i) use ($avatarMax) {
                // Pick a random avatar id (1-70)
                $avatarId = rand(1, $avatarMax);
                $url = "https://i.pravatar.cc/300?img={$avatarId}";

                // Generate a unique filename
                $filename = 'citizen_photos/' . Str::uuid() . '.jpg';

                // Download and store the image locally
                try {
                    $imageContents = file_get_contents($url);
                    Storage::disk('public')->put($filename, $imageContents);
                    $citizen->photo_path = $filename;
                } catch (\Exception $e) {
                    // If download fails, use a placeholder
                    $citizen->photo_path = 'citizen_photos/placeholder.jpg';
                }

                $citizen->save();
            });
    }
}

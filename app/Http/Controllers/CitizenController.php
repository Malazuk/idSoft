<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CitizenController extends Controller
{
    public function create()
{
    return view('citizen_registeration');
}

public function preview(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'other_names' => 'nullable|string|max:255',
        'hometown' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'address' => 'required|string|max:255',
        'contact_info' => 'required|string|max:255',
        'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
    ]);

    // Save photo temporarily and get the path
    $photoPath = $request->file('photo')->store('temp_photos', 'public');

    // Add the photo path to the validated data
    $validated['photo_path'] = $photoPath;

    // Remove the `photo` field to avoid serialization issues
    unset($validated['photo']);

    // Save only serializable data to the session
    session(['citizen_data' => $validated]);

    return redirect()->route('citizen.showPreview');
}

public function showPreview()
{
    $data = session('citizen_data');

    if (!$data) {
        return redirect()->route('citizen.create')->with('error', 'No data to preview.');
    }

    return view('citizen_preview', ['data' => $data, 'photoPath' => $data['photo_path']]);
}

public function store(Request $request)
{
    $data = session('citizen_data');

    if (!$data) {
        return redirect()->route('citizen.create')->with('error', 'No data found in session.');
    }

    // Move photo from temp to permanent
    $finalPath = str_replace('temp_photos', 'citizen_photos', $data['photo_path']);
    Storage::disk('public')->move($data['photo_path'], $finalPath);

    // Store data into the database
    $citizen = Citizen::create([
        'first_name' => $data['first_name'],
        'surname' => $data['surname'],
        'other_names' => $data['other_names'],
        'hometown' => $data['hometown'],
        'date_of_birth' => $data['date_of_birth'],
        'address' => $data['address'],
        'contact_info' => $data['contact_info'],
        'photo_path' => $finalPath,
    ]);

    // Clear session data
    session()->forget('citizen_data');

    return redirect()->route('citizen.printId', $citizen->id)->with('success', 'Citizen registered successfully!');
}
public function printId($id)
{
    $citizen = Citizen::findOrFail($id);

    return view('citizen_id_card', ['citizen' => $citizen]);
}
public function search(Request $request)
{
    $query = Citizen::query();

    // Check if any search criteria are provided
    if ($request->filled('first_name') || $request->filled('surname') || $request->filled('citizen_id') || 
        $request->filled('hometown') || $request->filled('date_of_birth') || $request->filled('address')) {

        // Apply filters based on user input
        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->filled('surname')) {
            $query->where('surname', 'like', '%' . $request->surname . '%');
        }

        if ($request->filled('citizen_id')) {
            $query->where('citizen_id', $request->citizen_id);
        }

        if ($request->filled('hometown')) {
            $query->where('hometown', 'like', '%' . $request->hometown . '%');
        }

        if ($request->filled('date_of_birth')) {
            $query->whereDate('date_of_birth', $request->date_of_birth);
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        // Execute the query and get results
        $citizens = $query->get();
    } else {
        // No criteria provided, return an empty result set
        $citizens = collect(); // Empty collection
    }

    return view('citizen_search_results', ['citizens' => $citizens]);
}
public function showSearchForm()
{
    return view('citizen_search');
}
public function destroy($id, Request $request)
{
    $citizen = Citizen::findOrFail($id);

    // Delete the citizen record
    $citizen->delete();

    // Retrieve remaining records based on previous search criteria
    $query = Citizen::query();

    if ($request->filled('first_name')) {
        $query->where('first_name', 'like', '%' . $request->first_name . '%');
    }

    if ($request->filled('surname')) {
        $query->where('surname', 'like', '%' . $request->surname . '%');
    }

    if ($request->filled('citizen_id')) {
        $query->where('citizen_id', $request->citizen_id);
    }

    if ($request->filled('hometown')) {
        $query->where('hometown', 'like', '%' . $request->hometown . '%');
    }

    if ($request->filled('date_of_birth')) {
        $query->whereDate('date_of_birth', $request->date_of_birth);
    }

    if ($request->filled('address')) {
        $query->where('address', 'like', '%' . $request->address . '%');
    }

    $citizens = $query->get();

    // return view('citizen_search_results', ['citizens' => $citizens])->with('success', 'Citizen deleted successfully.');
    return redirect()->route('citizen.search')->with([
        'citizens' => $citizens,
        'success' => 'Citizen deleted successfully.',
    ]);
}
public function edit($id)
{
    $citizen = Citizen::findOrFail($id);

    return view('citizen_edit', ['citizen' => $citizen]);
}
public function update(Request $request, $id)
{
    $citizen = Citizen::findOrFail($id);

    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'other_names' => 'nullable|string|max:255',
        'hometown' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'address' => 'required|string|max:500',
        'contact_info' => 'required|string|max:255',
    ]);

    $citizen->update($validated);

    // Retrieve updated records based on previous search criteria
    $query = Citizen::query();

    if ($request->filled('first_name')) {
        $query->where('first_name', 'like', '%' . $request->first_name . '%');
    }

    if ($request->filled('surname')) {
        $query->where('surname', 'like', '%' . $request->surname . '%');
    }

    if ($request->filled('citizen_id')) {
        $query->where('citizen_id', $request->citizen_id);
    }

    if ($request->filled('hometown')) {
        $query->where('hometown', 'like', '%' . $request->hometown . '%');
    }

    if ($request->filled('date_of_birth')) {
        $query->whereDate('date_of_birth', $request->date_of_birth);
    }

    if ($request->filled('address')) {
        $query->where('address', 'like', '%' . $request->address . '%');
    }

    $citizens = $query->get();

    // return view('citizen_search_results', ['citizens' => $citizens])->with('success', 'Citizen updated successfully.');
    return redirect()->route('citizen.search')->with([
        'citizens' => $citizens,
        'success' => 'Citizen updated successfully.',
    ]);
}
public function all()
{
    $citizens = \App\Models\Citizen::all();
    return view('citizen_all', compact('citizens'));
}
}

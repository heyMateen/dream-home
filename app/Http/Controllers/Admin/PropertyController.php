<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::orderBy("created_at", "DESC")->with('owner')->paginate(10);
        return view('content.admin.properties.properties', compact('properties'));
    }

    public function show_create_view(Request $request)
    {
        $owners = User::where('role', 'owner')->get(); // Fetch users who are owners
        return view('content.admin.properties.create-property', compact('owners'));
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'owner_id' => ['required', 'integer', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:available,sold'],
        ]);
        $property = Property::create($validated_data);

        if (!$property) {
            return back()->with('error', 'Something went wrong while creating the property.');
        }

        return back()->with('success', 'Property created successfully.');
    }

    public function show_update_view(Request $request, Property $property)
    {
        if (!$property) {
            abort(404, 'Property not found.');
        }
        $owners = User::where('role', 'owner')->get(); // Fetch users who are owners
        return view('content.admin.properties.update-property', compact('property', 'owners'));
    }

    public function update(Request $request, $property_id)
    {
        $validated_data = $request->validate([
            'owner_id' => ['required', 'integer', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:available,sold'],
        ]);

        $property = Property::findOrFail($property_id);
        $updated = $property->update($validated_data);

        if (!$updated) {
            return back()->with('error', 'Something went wrong while updating the property.');
        }

        return redirect()->route('admin.properties.view')->with('success', 'Property updated successfully.');
    }

    public function delete(Request $request, $property_id)
    {
        $property = Property::findOrFail($property_id);
        $deleted = $property->delete();

        if (!$deleted) {
            return back()->with('error', 'Something went wrong while deleting the property.');
        }

        return redirect()->route('admin.properties.view')->with('success', 'Property deleted successfully.');
    }
}

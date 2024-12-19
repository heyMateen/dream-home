<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display a list of users
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10); // Fetch all users
        return view('content.admin.users.users', compact('users'));
    }

    // Show the form to create a new user
    public function show_create_view(Request $request)
    {
        return view('content.admin.users.create-user');
    }

    // Store a new user in the database
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            'phone_number' => 'required|string|max:15|unique:users,phone_number', // Ensure phone number is unique
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                ,
                'confirmed',
            ], // Ensure password is confirmed
            'role' => 'required|in:superadmin,owner,client,staff', // Ensure valid role
            'status' => 'required|in:active,inactive', // Ensure valid status
            'profile_image' => [
                'required',
                File::image()
                    ->max(12 * 1024)
            ], // Validate image
            'address' => 'required|string|max:255', // Address validation
            'city' => 'required|string|max:255', // City validation
            'state' => 'required|string|max:255', // State validation
            'postal_code' => 'required|string|max:10', // Postal code validation
        ]);

        // Handle file upload for profile image
        $profileImagePath = null;
        $fileName = null;
        if ($request->hasFile('profile_image')) {
            // Get the file's original extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            // Generate a unique file name using uniqid() and the file extension
            $fileName = uniqid('profile_') . '.' . $extension;

            // Store the file in the 'uploads/users' folder and get the path
            $profileImagePath = $request->file('profile_image')->storeAs('uploads/users', $fileName, 'public');
        }
        $validatedData['status'] = $request->status === 'active' ? '1' : '0';
        // Create the user record with the new fields
        $created = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'status' => $validatedData['status'],
            'profile_image' => $fileName, // Save image path in the database
            'address' => $validatedData['address'], // Save address
            'city' => $validatedData['city'], // Save city
            'state' => $validatedData['state'], // Save state
            'postal_code' => $validatedData['postal_code'], // Save postal code
        ]);
        if (!$created) {
            return redirect()->back()->with('error', 'Failed to add user!');
        }
        return redirect()->back()->with('success', 'User added successfully!');
    }
    // Show the form to update an existing user
    public function show_update_view(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        return view('content.admin.users.update-user', compact('user'));
    }

    // Update the user information
    public function update(Request $request, $user_id)
    {
        // dd($request->all());
        // Find the user to update
        $user = User::findOrFail($user_id);

        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignore unique validation for the current user
            'phone_number' => 'required|string|max:15|unique:users,phone_number,' . $user->id, // Ignore unique validation for the current user
            'role' => 'required|in:superadmin,owner,client,staff', // Validate role from allowed options
            'password' => [
                'nullable',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                ,
                'confirmed',
            ], //           
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive', // Ensure valid status
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'profile_image' => [
                'nullable',
                File::image()
                    ->max(12 * 1024)
            ], //
        ]);
        $validatedData['status'] = $request->status === 'active' ? '1' : '0';
        // Update user data
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->role = $validatedData['role'];
        $user->address = $validatedData['address'];
        $user->city = $validatedData['city'];
        $user->state = $validatedData['state'];
        $user->postal_code = $validatedData['postal_code'];
        $user->status = $validatedData['status'];

        // If a new password is provided, hash and update it
        if ($request->has('password') && $validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        // If a new profile image is uploaded, handle the file upload
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Generate a unique name for the new image
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $fileName = uniqid('profile_') . '.' . $extension;

            // Store the new profile image and update the user's profile image path
            $profileImagePath = $request->file('profile_image')->storeAs('uploads/users', $fileName, 'public');

            // Update the user's profile image field with the new path
            $user->profile_image = $fileName;
        }

        // Save the updated user data
        $user->save();

        // Redirect to the users list with a success message
        return redirect()->route('admin.users.view')->with('success', 'User updated successfully!');
    }
    // Delete a user
    public function delete(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        // Delete the user
        $user->delete();

        // Redirect to the users list with a success message
        return redirect()->route('admin.users.view')->with('success', 'User deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Display a list of clients
    public function index()
    {
        $clients = User::where('role', 'client')->get(); // Fetch all clients
        return view('content.admin.clients.clients', compact('clients'));
    }

    // Show the form to create a new client
    public function show_create_view(Request $request)
    {
        return view('content.admin.clients.create-client');
    }

    // Store a new client in the database
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:superadmin,owner,client,staff',
        ]);

        // Create the client (user) and hash the password
        $client = Client::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirect to the clients list with a success message
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully!');
    }

    // Show the form to update an existing client
    public function show_update_view(Request $request, Client $client)
    {
        return view('content.admin.clients.update-client', compact('client'));
    }

    // Update the client information
    public function update(Request $request, $client_id)
    {
        $client = Client::findOrFail($client_id);

        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $client->id,
            'role' => 'required|in:superadmin,owner,client,staff',
            'password' => 'nullable|string|min:8|confirmed', // password is optional during update
        ]);

        // Update the client data
        $client->first_name = $validatedData['first_name'];
        $client->last_name = $validatedData['last_name'];
        $client->email = $validatedData['email'];
        $client->role = $validatedData['role'];

        // If a new password is provided, hash and update it
        if ($request->has('password')) {
            $client->password = Hash::make($validatedData['password']);
        }

        // Save the changes
        $client->save();

        // Redirect to the clients list with a success message
        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully!');
    }

    // Delete a client
    public function delete(Request $request, $client_id)
    {
        $client = Client::findOrFail($client_id);

        // Delete the client
        $client->delete();

        // Redirect to the clients list with a success message
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully!');
    }
}

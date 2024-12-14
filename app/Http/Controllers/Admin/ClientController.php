<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('content.admin.clients.clients');

    }
    public function show_create_view(Request $request)
    {

    }
    public function store(Request $request)
    {

    }
    public function show_update_view(Request $request, Client $client)
    {

    }
    public function update(Request $request, $client_id)
    {

    }
    public function delete(Request $request, $client_id)
    {

    }
}

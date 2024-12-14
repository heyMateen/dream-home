<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('content.admin.properties.properties');
    }
    public function show_create_view(Request $request)
    {

    }
    public function store(Request $request)
    {

    }
    public function show_update_view(Request $request, Property $property)
    {

    }
    public function update(Request $request, $property_id)
    {

    }
    public function delete(Request $request, $property_id)
    {

    }
}

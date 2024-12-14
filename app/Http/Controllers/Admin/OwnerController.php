<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        return view('content.admin.owners.owners');

    }
    public function show_create_view(Request $request)
    {

    }
    public function store(Request $request)
    {

    }
    public function show_update_view(Request $request, Owner $owner)
    {

    }
    public function update(Request $request, $owner_id)
    {

    }
    public function delete(Request $request, $owner_id)
    {

    }
}

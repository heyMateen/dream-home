<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('content.admin.appointments.appointments');
    }
    public function show_create_view(Request $request)
    {

    }
    public function store(Request $request)
    {

    }
    public function show_update_view(Request $request, Appointment $appointment)
    {

    }
    public function update(Request $request, $appointment_id)
    {

    }
    public function delete(Request $request, $appointment_id)
    {

    }
}

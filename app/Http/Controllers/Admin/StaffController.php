<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class StaffController extends Controller
{
    public function index(Request $request)
    {
        $staff_members = Staff::orderBy("created_at", "desc")
            ->with('user') 
            ->paginate(5);

        return view("content.admin.staff.staff", compact("staff_members"));
    }

    public function show_create_view(Request $request)
    {
        $users = User::where('role', 'staff')->get();
        $branches = Branch::all();
        return view("content.admin.staff.create-staff", compact('users', 'branches'));
    }
        public function store(Request $request)
        {
            $validated = $request->validate([
                'user_id' => [
                    'required',
                    'integer',
                    'exists:users,id',
                    'unique:staff,user_id',
                ],
                'branch_id' => [
                    'required',
                    'integer',
                    'exists:branches,id',
                ],
                'role' => [
                    'required',
                    'string',
                    'in:manager,employee',
                ],
                'status' => [
                    'required',
                    'in:active,inactive',
                ],
            ]);

            // Save the staff member to the database
            Staff::create([
                'user_id' => $validated['user_id'],
                'branch_id' => $validated['branch_id'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ]);

            return redirect()->route('admin.staff.view')->with('success', 'Staff member added successfully!');
        }

    public function show_update_view(Request $request, Staff $staff)
    {
        if (!$staff) {
            abort(404, 'Staff member not found');
        }
        return view("content.admin.branches.update-branch", compact("branch"));
    }
    public function update(Request $request, $staff_id)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('branches')->ignore($staff_id)],
            'phone_number' => ['required', 'string', 'regex:/^\+92[0-9]{10}$/', Rule::unique('branches')->ignore($staff_id)],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'regex:/^[0-9]{5}$/', Rule::unique('branches')->ignore($staff_id)],
            'status' => ['required', 'string', 'in:active,inactive'],
        ]);

        $staff = Staff::findOrFail($staff_id);
        $validated_data['status'] = $request->status === 'active' ? '1' : '0';
        $udpated = $staff->update($validated_data);
        if (!$udpated)
            return back()->with('error', 'something went wrong...');
        return redirect()->route('admin.staff.view')->with('success', 'Staff updated successfully');
    }
    public function delete(Request $request, $staff_id)
    {
        $staff = Staff::findOrFail($staff_id);
        $delete = $staff->delete();
        if (!$delete) {
            return back()->with('error', 'something went wrong...');
        }
        return redirect()->route('admin.staff.view')->with('success', 'Staff deleted successfully');

    }
}

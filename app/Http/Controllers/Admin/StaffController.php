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
        $users = User::where('role', 'staff')->whereDoesntHave('is_already_staff')->get();
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
        // check if there is no manager of the branch to whom the user is being assigned as manager
        $branch_has_manager = Staff::where('branch_id', $request->branch_id)->where('role', 'manager')->first();
        if ($branch_has_manager) {
            return back()->withErrors(['branch_id' => 'This branch already has a manager'])->withInput();
        }
        $validated['status'] = $request->status === 'active' ? '1' : '0';
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
        $users = User::where('role', 'staff')->whereDoesntHave('is_already_staff', function ($query) use ($staff) {
            $query->where('id', '!=', $staff->id);
        })->get();
        $branches = Branch::all();
        return view("content.admin.staff.update-staff", compact("staff", "users", "branches"));
    }
    public function update(Request $request, $staff_id)
    {
        $validated_data = $request->validate([
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('staff')->ignore($staff_id),
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
                'string',
                'in:active,inactive',
            ],
        ]);

        $staff = Staff::findOrFail($staff_id);

        if ($validated_data['role'] === 'manager') {
            $branch_has_manager = Staff::where('branch_id', $validated_data['branch_id'])->where('role', 'manager')->where('id', '!=', $staff_id)->first();
            if ($branch_has_manager) {
                return back()->withErrors(['branch_id' => 'This branch already has a manager'])->withInput();
            }
        }
        $validated_data['status'] = $request->status === 'active' ? '1' : '0';
        $staff->update($validated_data);

        return redirect()->route('admin.staff.view')->with('success', 'Staff updated successfully!');
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

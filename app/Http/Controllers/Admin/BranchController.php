<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    private $store_rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:branches'],
        'phone_number' => ['required', 'string', 'regex:/^\+92[0-9]{10}$/', 'unique:branches'],
        'address' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'state' => ['required', 'string', 'max:255'],
        'postal_code' => ['required', 'string', 'regex:/^[0-9]{5}$/', 'unique:branches'],
        'status' => ['required', 'string', 'in:active,inactive'],
    ];
    public function index(Request $request)
    {
        $branches = Branch::orderBy("created_at", "desc")->with('manager')->paginate(5);
        return view("content.admin.branches.branches", compact("branches"));
    }
    public function show_create_view(Request $request)
    {
        return view("content.admin.branches.create-branch");
    }
    public function store(Request $request)
    {

        $validated_data = $request->validate($this->store_rules);
        $validated_data['status'] = $request->status === 'active' ? '1' : '0';
        $branch = Branch::create($validated_data);
        if (!$branch) {
            return back()->with('error', 'Something went wrong...');
        }
        return back()->with('success', 'Branch successfully created');
    }
    public function show_update_view(Request $request, Branch $branch)
    {
        if (!$branch) {
            abort(404, 'Branch does not exist');
        }
        return view("content.admin.branches.update-branch", compact("branch"));
    }
    public function update(Request $request, $branch_id)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('branches')->ignore($branch_id)],
            'phone_number' => ['required', 'string', 'regex:/^\+92[0-9]{10}$/', Rule::unique('branches')->ignore($branch_id)],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'regex:/^[0-9]{5}$/', Rule::unique('branches')->ignore($branch_id)],
            'status' => ['required', 'string', 'in:active,inactive'],
        ]);

        $branch = Branch::findOrFail($branch_id);
        $validated_data['status'] = $request->status === 'active' ? '1' : '0';
        $udpated = $branch->update($validated_data);
        if (!$udpated)
            return back()->with('error', 'something went wrong...');
        return redirect()->route('admin.branches.view')->with('success', 'Branch updated successfully');
    }
    public function delete(Request $request, $branch_id)
    {
        $branch = Branch::findOrFail($branch_id);
        $delete = $branch->delete();
        if (!$delete){
            return back()->with('error', 'something went wrong...');
        }
        return redirect()->route('admin.branches.view')->with('success', 'Branch deleted successfully');

    }
}

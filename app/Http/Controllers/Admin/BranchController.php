<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request){
        $branches = Branch::orderBy("created_at","desc")->paginate(5);
        return view("content.admin.branches.branches", compact("branches"));
    }
}

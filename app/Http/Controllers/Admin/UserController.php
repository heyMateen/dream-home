<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('content.admin.users.users', compact('users'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('content.admin.transactions.transactions');

    }
    public function show_create_view(Request $request)
    {

    }
    public function store(Request $request)
    {

    }
    public function show_update_view(Request $request, Transaction $transaction)
    {

    }
    public function update(Request $request, $transaction_id)
    {

    }
    public function delete(Request $request, $transaction_id)
    {

    }
}

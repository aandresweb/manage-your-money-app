<?php

namespace App\Http\Controllers;

use App\Http\Resources\Transaction\Transaction as AppTransaction;
use App\Http\Resources\Transaction\TransactionCollection;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function all()
    {
        return new TransactionCollection(Transaction::all());
    }

    public function show(Transaction $transaction)
    {
        return new AppTransaction($transaction);
    }
}

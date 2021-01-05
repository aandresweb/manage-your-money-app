<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransaction;
use App\Http\Resources\Transaction\Transaction as AppTransaction;
use App\Http\Resources\Transaction\TransactionCollection;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function all()
    {
        return new TransactionCollection(
            Transaction::where('user_id', Auth::user()->id)->get()
        );
    }

    public function show(Transaction $transaction)
    {
        return new AppTransaction($transaction);
    }

    public function store(StoreTransaction $request)
    {
        $transaction = Transaction::create($request->all());
        return new AppTransaction($transaction);
    }

    public function delete($id)
    {
        return Transaction::findOrfail($id)->delete();
    }
}

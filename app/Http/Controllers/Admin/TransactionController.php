<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// dependency
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0 ");

        $data = [
            'transactions' => Transaction::all()
        ];

        return view('pages.admin.transaction.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $data = [
            'transaction' => $transaction
        ];

        return view('pages.admin.transaction.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $data = [
            'transaction' => $transaction
        ];

        return view('pages.admin.transaction.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'name' => ['required', 'max:84'],
            'email' => ['required', 'max:112'],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        $data = $request->all();

        Transaction::findOrFail($transaction->id)
            ->update($data);

        Alert::toast('Transactin succesfully updated', 'success');
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Transaction::destroy($transaction->id);

        Alert::toast('Transacation succesfully deleted', 'success');
        return back();
    }

    /**
     * Change status customer.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:SUCCESS,FAILED,PENDING'
        ]);

        $status = Transaction::findOrFail($id);
        $status->status = $request->status;

        $status->save();

        Alert::toast("Transaction change status to $request->status", 'success');
        return redirect()->route('transaction.index');
    }
}

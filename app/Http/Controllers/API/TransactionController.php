<?php

namespace App\Http\Controllers\API;

use App\Transaction;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show(Request $request, $id)
    {

        $transaction = Transaction::with(['details.product'])->find($id);

        if ($transaction)
            return ResponseFormatter::success(200, 'The data is successfully retrieved', $transaction);
        else
            return ResponseFormatter::error(404, "Data with id = $id nof found", null);
    }
}

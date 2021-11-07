<?php

namespace App\Http\Controllers\API;

use App\Product;
use App\Transaction;
use App\TransactionDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;

use Illuminate\Http\Request;

// dependency
use Uuid;

class CheckoutController extends Controller
{
    // NOTED KEDEPANNYA DETAIL TANPA HARUS ADA CREATED AT DAN UPDATE
    public function store(CheckoutRequest $request)
    {
        $data = $request->except('details');
        $data['uuid'] = Uuid::generate(4)->string;

        $transaction = Transaction::create($data);
        foreach ($request->details as $product) {
            $details[] = new TransactionDetail([
                'transaction_id' => $transaction->id,
                'product_id' => $product
            ]);

            Product::find($product)->decrement('quantity');
        }

        $transaction->details()->saveMany($details);
        return ResponseFormatter::success(200, 'Transaction success added', $transaction);
    }
}

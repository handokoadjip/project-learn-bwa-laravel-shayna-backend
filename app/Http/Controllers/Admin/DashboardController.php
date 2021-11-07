<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'income' => Transaction::where('status', 'SUCCESS')->sum('total'),
            'sales' => Transaction::count(),
            'transactions' => Transaction::all(),
            'pie' => [
                'success' => Transaction::where('status', 'SUCCESS')->count(),
                'failed' => Transaction::where('status', 'FAILED')->count(),
                'pending' => Transaction::where('status', 'PENDING')->count()
            ]
        ];

        return view('pages.admin.dashboard.index', compact('data'));
    }
}

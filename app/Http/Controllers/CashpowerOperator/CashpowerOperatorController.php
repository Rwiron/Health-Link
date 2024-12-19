<?php

namespace App\Http\Controllers\CashpowerOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashpowerOperatorController extends Controller
{
    public function dashboard()
    {
        return view('cashpower_operator.dashboard');
    }
}
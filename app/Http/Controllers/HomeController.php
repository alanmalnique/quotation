<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show(Request $request)
    {
        $currencies = Currency::query()->get();
        return view('home', compact('currencies'));
    }
}

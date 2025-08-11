<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function pricePage(){
        $prices = Plan::all();
        return view('user-side.price', compact('prices'));
    }
}

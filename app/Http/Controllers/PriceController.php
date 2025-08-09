<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function pricePage(){
        return view('user-side.price');
    }
}

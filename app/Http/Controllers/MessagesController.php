<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exchange;
use App\Models\Message;

class MessagesController extends Controller
{
    public function index()
    {
        return view('user-side.messages');
    }
} 
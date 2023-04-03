<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function Stripe(){
        return view('user.stripe');
    }
}

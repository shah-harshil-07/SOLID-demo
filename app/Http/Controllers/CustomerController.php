<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show(Request $request) {
        return view("welcome");
    }
}

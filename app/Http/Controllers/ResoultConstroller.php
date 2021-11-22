<?php

namespace App\Http\Controllers;

class ResoultConstroller extends Controller
{
    public function __invoke(Request $request)
    {
        return view('result');
    }
}

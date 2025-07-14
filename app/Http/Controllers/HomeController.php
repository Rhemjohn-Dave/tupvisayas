<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Official;

class HomeController extends Controller
{
    public function index()
    {
        $officials_preview = Official::orderBy('order')->limit(3)->get();
        return view('pages.home', compact('officials_preview'));
    }
}

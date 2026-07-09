<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Official;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::orderBy('order')->get();
        return view('pages.officials', compact('officials'));
    }
<<<<<<< HEAD
=======

    public function show($id)
    {
        $official = Official::findOrFail($id);
        return view('pages.officials_show', compact('official'));
    }
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
}

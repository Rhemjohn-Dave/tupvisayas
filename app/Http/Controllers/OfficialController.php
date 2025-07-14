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

    public function show($id)
    {
        $official = Official::findOrFail($id);
        return view('pages.officials_show', compact('official'));
    }
}

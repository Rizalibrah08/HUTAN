<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporController extends Controller
{
      public function index()
    {
        return view('backend.lapor.index');
    }
}

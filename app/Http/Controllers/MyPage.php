<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPage extends Controller
{
    public function Regions()
    {
        return view('regions');
    }
}

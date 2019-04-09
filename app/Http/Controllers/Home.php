<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Home extends Controller
{
    public function home()
    {
        return "Hello your wellcome :)";
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Get extends Controller
{


    public function sell(Request $req)
    {
        if (!$req->has('status'))
        {
           return "please enter status";
        }
        if ($req->input('status') == 'open')
        {
            $data = $this->get_sells('open');
        }
        

        return response()->json($data);

        // foreach($data as $key => $value)
        // {
        //     var_dump($value);
        // }
    }
}
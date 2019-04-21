<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class Account extends Controller
{


    public function get(Request $req)
    {
        $response = [];
        $status = ["status"=>"ok"];
        if (!$req->has('status'))
        {
           return "please enter status";
        }
        $data = $this->get_sells($req->input('status'));
        
        if ($data === false)
        {
            $response["status"]= "ok";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"] = $data;

        return response()->json($response);

    }

 
 
    public function set(Request $req)
    {
        $en = Crypt::encrypt("hello_world");
        var_dump($en);
        var_dump(Crypt::decrypt($en));
        return "hello Set/sell";
    }
 
 
 
    public function update(Request $req)
    {
        return "hello Set/sell";
    }



}
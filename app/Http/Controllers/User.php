<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class User extends Controller
{


    public function get(Request $req)
    {
        $response = [];
        $status = ["status"=>"ok"];
        if (!$req->has('status'))
        {
           return "please enter status";
        }
        $data = "hi";
        
        if ($data === false)
        {
            $response["status"]= "ok";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"] = $data;

        return response()->json($response);

    }

    public function auth(Request $req)
    {
        $response = [];
        if(!$req->has('hash'))
        {
            $response["status"] = "false";
            $response["message"] = "wrong input";
            return response()->json($response);
        }
        /**
         * contain 
         * - user_name
         * - password
         * - phone_number
         *
         * @var [type]
         */
        $auth_array = $this->un_hash($req->input('hash'));
        $user_info = $this->auth_db($auth_array["user_name"]);

        if(!isset($user_info->all('password')[0]))
        {
            $response["status"] = "false";
            $response["message"] = "wrong user_name";
    
            return response()->json($response);    
        }
        if(password_verify($auth_array["password"], $user_info->all('password')[0]->password) && $auth_array["phone_number"] != $user_info->all('phone_number')[0]->phone_number)
        {
            $response["status"] = "false";
            $response["message"] = "wrong phone_number or password";
    
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"] = $data;

        return response()->json($response);
    }
 

    public function auth_db($_user_name)
    {
        $db_result = app('db')->table('user')
            ->select('id', 'user_name', 'password', 'phone_number')
            ->where('user_name', $_user_name)
            ->get();
        return $db_result;        
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class User extends Controller
{


    public function login(Request $req)
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
        $user_info  = $this->auth_db($auth_array["user_name"]);

        if(!isset($user_info->all('password')[0]))
        {
            $response["status"] = "false";
            $response["message"] = "wrong user_name";
            
            return response()->json($response);    
        }
        $user_id      = $user_info->all()[0]->id;
        $password     = $user_info->all('password')[0]->password;
        $phone_number = $user_info->all('phone_number')[0]->phone_number;
        if(!password_verify($auth_array["password"], $password))
        {

            $response["status"]  = "false";
            $response["message"] = "wrong password";
    
            return response()->json($response);
        }
        
        if($phone_number === null)
        {
            $this->set_phone($user_id, $auth_array["phone_number"]);
        }
        elseif($auth_array["phone_number"] != $phone_number)
        {
            $response["status"]  = "false";
            $response["message"] = "wrong phone_number";
    
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"]   = ["token" => $this->make_token($user_id)];

        return response()->json($response);
    }
 

    public function set_phone($_user_id, $_phone_number)
    {
        $db_result = app('db')->table('user')
            ->where('id', $_user_id)
            ->update(["phone_number" => $_phone_number]);
        
        return $db_result;  
    }
    
    public function auth_db($_user_name)
    {
        $db_result = app('db')->table('user')
            ->select('id', 'user_name', 'password', 'phone_number')
            ->where('user_name', $_user_name)
            ->get();

        return $db_result;        
    }
 

}
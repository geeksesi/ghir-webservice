<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class Buy extends Controller
{


    public function get(Request $req)
    {
        return "hello Get/buy";
    }

    /**
     * [status description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function status(Request $_req)
    {
        $response = [];
        if (!$_req->has('status'))
        {
           $response["status"]  = "false";
           $response["message"] = "please enter status";
           return response()->json($response);
        }
        $data = $this->db_status($_req->input('status'));
        
        if ($data === false)
        {
            $response["status"]  = "false";
            $response["message"] = "status is wrong";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"]   = $data;

        return response()->json($response);
    }
 
    /**
     * [db_status description]
     *
     * @param   [type]  $_status  [$_status description]
     *
     * @return  [type]            [return description]
     */
    public function db_status($_status)
    {
        /**

         */
        $status_type = ["open", "closed", "removed", "edited", "rejected", "complete"];
        if (!in_array($_status, $status_type))
        {
            return false;
        }
        $db_result = app('db')->table('buy')
            ->where('offer_status', $_status)
            ->join('user',      "buy.user_id"      ,'=',   "user.id")
            ->join('product',   "buy.product_id"   ,'=',   "product.id")
            ->get();
        return $db_result;
    }



    /**
     * [id description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function id(Request $_req)
    {
        $response = [];
        if (!$_req->has('id'))
        {
           $response["status"]  = "false";
           $response["message"] = "please enter id";
           return response()->json($response);
        }
        $data = $this->db_id($_req->input('id'));
        
        if ($data === false)
        {
            $response["status"]  = "false";
            $response["message"] = "id is wrong";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"]   = $data;

        return response()->json($response);
    }
    /**
     * [db_id description]
     *
     * @param   [type]  $_id  [$_id description]
     *
     * @return  [type]        [return description]
     */
    public function db_id($_id)
    {
        if (!is_numeric($_id))
        {
            return false;
        }
        $db_result = app('db')->table('buy')
            ->where('buy.id', $_id)
            ->join('user',      "buy.user_id"      ,'=',   "user.id")
            ->join('product',   "buy.product_id"   ,'=',   "product.id")
            ->get();
        return $db_result;
    }

    /**
     * [user description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function user(Request $_req)
    {
        $response = [];
        if (!$_req->has('user_id'))
        {
           $response["status"]  = "false";
           $response["message"] = "please enter id";
           return response()->json($response);
        }
        $product_id = ($_req->has('product_id')) ? $_req->input('product_id') :null;
        $status     = ($_req->has('status'))     ? $_req->input('status')     :null;
        $start_time = ($_req->has('start_time')) ? $_req->input('start_time') :null;
        $end_time   = ($_req->has('end_time'))   ? $_req->input('end_time')   :null;
        if(isset($start_time) && $end_time === null)
        {
            $end_time = time(); // current Time
        }
        $data = $this->db_user($_req->input('id'), $product_id, $status, $start_time, $end_time);
        
        if ($data === false)
        {
            $response["status"]  = "false";
            $response["message"] = "inputs is wrong";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"]   = $data;

        return response()->json($response);
    }

    public function db_user($_user_id, $_product_id = null, $_status = null, $_start_time = null, $_end_time = null)
    {
        if (!is_numeric($_id))
        {
            return false;
        }
        $status_type = ["open", "closed", "removed", "edited", "rejected", "complete"];
        if ($_status !== null && !in_array($_status, $status_type))
        {
            return false;
        }
        $db_result = app('db')->table('buy')
            ->where('buy.id', $_id)
            ->join('user',      "buy.user_id"      ,'=',   "user.id")
            ->join('product',   "buy.product_id"   ,'=',   "product.id")
            ->get();
        return $db_result;
    }

   
    public function product(Request $_req)
    {
        return "hello Get/buy";

    }
    
    public function timestamp(Request $_req)
    {
        return "hello Get/buy";

    }
    
    public function history(Request $_req)
    {
        return "hello Get/buy";

    }

    
    public function set(Request $_req)
    {
        $en = Crypt::encrypt("hello_world");
        var_dump($en);
        var_dump(Crypt::decrypt($en));
        return "hello Set/sell";
    }
 
 
 
    public function update(Request $_req)
    {
        return "hello Set/sell";
    }



}
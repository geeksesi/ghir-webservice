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
        $db_result = app('db')->table('buy_order')
            ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            ->where('buy_order.id', $_id)
            ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
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
        $start_time = ($_req->has('start_time')) ? $_req->input('start_time') :null;
        $end_time   = ($_req->has('end_time'))   ? $_req->input('end_time')   :null;
        if(isset($start_time) && $end_time === null)
        {
            $end_time = time(); // current Time
        }
        if($end_time < $start_time)
        {
            $response["status"]  = "false";
            $response["message"] = "start_time is bigger than end time O_o";
            return response()->json($response);
        }
        $data = $this->db_user($_req->input('user_id'), $start_time, $end_time);
        
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

    public function db_user($_user_id, $_start_time = null, $_end_time = null)
    {
        if (!is_numeric($_user_id))
        {
            return false;
        }
        if(isset($_start_time) && isset($_end_time))
        {
            $db_result = app('db')->table('buy_order')
                ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                ->where(
                    [
                        ['buy_order.user_id', $_user_id],
                        ['buy_order.order_timestamp', ">", $_start_time],
                        ['buy_order.order_timestamp', "<", $_end_time],
                    ])
                ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                ->get();
        }
        else
        {
            $db_result = app('db')->table('buy_order')
                ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                ->where('buy_order.user_id', $_user_id)
                // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                ->get();
        }
        return $db_result;
    }

   
   public function timestamp(Request $_req)
    {
        $response = [];
        if (!$_req->has('start_time'))
        {
           $response["status"]  = "false";
           $response["message"] = "please enter id";
           return response()->json($response);
        }
        $user_id    = ($_req->has('user_id'))       ? $_req->input('user_id')    :null;
        $end_time   = ($_req->has('end_time'))      ? $_req->input('end_time')   :null;
        $start_time = ($_req->has('start_time'))    ? $_req->input('start_time') :null;

        if($end_time === null)
        {
            $end_time = time(); // current Time
        }
        if($end_time < $start_time)
        {
            $response["status"]  = "false";
            $response["message"] = "start_time is bigger than end time O_o";
            return response()->json($response);
        }
        $data = $this->db_timestamp($user_id, $start_time, $end_time);
        
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


    public function db_timestamp($_user_id=null, $_start_time, $_end_time)
    {
        if (!is_numeric($_start_time) || !is_numeric($_end_time))
        {
            return false;
        }
        if(isset($_user_id))
        {
            $db_result = app('db')->table('buy_order')
                ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                ->where(
                    [
                        ['buy_order.user_id', $_user_id],
                        ['buy_order.order_timestamp', ">", $_start_time],
                        ['buy_order.order_timestamp', "<", $_end_time],
                    ])
                // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                ->get();
            }
            else
            {
                $db_result = app('db')->table('buy_order')
                    ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                    ->where(
                        [
                            ['buy_order.order_timestamp', ">", $_start_time],
                            ['buy_order.order_timestamp', "<", $_end_time],
                        ])
                    // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                    ->get();
        }
        return $db_result;
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
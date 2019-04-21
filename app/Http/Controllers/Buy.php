<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class Buy extends Controller
{

    /**
     * [get description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function get(Request $_req)
    {
        $response           = [];
        $option             = [];
        $option['limit']    = ($_req->has('limit')) ? $_req->input('limit') : null;
        $option['Desc']     = ($_req->has('desc'))  ? true                  : null;
        
        $data = $this->db_buy($option);
        
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
     * [db_buy description]
     *
     * @param   [type]  $_option  [$_option description]
     *
     * @return  [type]            [return description]
     */
    public function db_buy($_option = [])
    {
        if ($_option['limit'] === null && $_option['Desc'] === null)
        {
            $db_result = app('db')->table('buy_order')
                ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                ->get();
            }
        elseif($_option['limit'] !== null)
        {
            if($_option['Desc'] !== null)
            {
                $db_result = app('db')->table('buy_order')
                    ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                    // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                    ->orderBy('id', 'desc')
                    ->limit($_option['limit'])
                    ->get();
            }
            else
            {
                $db_result = app('db')->table('buy_order')
                    ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
                    // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
                    ->limit($_option['limit'])
                    ->get();

            }            
        }
        elseif($_option['Desc'] !== null)
        {
            $db_result = app('db')->table('buy_order')
            ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
            ->orderBy('id', 'desc')
            ->get();

        }
        else
        {
            return false;
        }
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
        $db_result = app('db')->table('buy_order')
            ->select('id', 'user_id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            ->where('buy_order.id', $_id)
            // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
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

    /**
     * [db_user description]
     *
     * @param   [type]  $_user_id     [$_user_id description]
     * @param   [type]  $_start_time  [$_start_time description]
     * @param   [type]  $_end_time    [$_end_time description]
     *
     * @return  [type]                [return description]
     */
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
                // ->join('user',      "buy_order.user_id"      ,'=',   "user.id")
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

   /**
    * [timestamp description]
    *
    * @param   Request  $_req  [$_req description]
    *
    * @return  [type]          [return description]
    */
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

    /**
     * [db_timestamp description]
     *
     * @param   [type]  $_user_id     [$_user_id description]
     * @param   [type]  $_start_time  [$_start_time description]
     * @param   [type]  $_end_time    [$_end_time description]
     *
     * @return  [type]                [return description]
     */
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


    /**
     * [set description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function set(Request $_req)
    {
        if(!$_req->has('user_id') || !$_req->has('quantity') || !$_req->has('price'))
        {
            $response["status"]  = "false";
            $response["message"] = "please fill all required value";
            return response()->json($response);
        }
        $user_id  = $_req->input('user_id');
        $quantity = $_req->input('quantity');
        $price    = $_req->input('price');
        if($_req->has('hash'))
        {
            $hash          = $_req->input('hash');
            $method        = 'AES-256-CBC';
            $hex_key       = '65be329dece8d3c45849e350ee616d0c';
            $hex_iv        = '7286550e4c2fa1cea3106a17f1e228ed';
            $hash_to_json  = openssl_decrypt($hash, $method, hex2bin($hex_key), 0 , hex2bin($hex_iv));
            $json_to_array = json_decode($hash_to_json, true);

            if($json_to_array['user_id'] !== $user_id || $json_to_array['quantity'] !== $quantity || $json_to_array['price'
            ] !== $price)
            {
                $response["status"]  = "false";
                $response["message"] = "hash values has not equal to post values";
                return response()->json($response);
            }
        }

        $id = $this->db_set($user_id, $quantity, $price);

        $response["status"]  = "ok";
        $response["message"] = "buy_order with id: ".$id." add to db";
        return response()->json($response);
    }
    
    /**
     * [db_set description]
     *
     * @param   [type]  $_user_id   [$_user_id description]
     * @param   [type]  $_quantity  [$_quantity description]
     * @param   [type]  $_price     [$_price description]
     *
     * @return  [type]              [return description]
     */
    public function db_set($_user_id, $_quantity, $_price)
    {
        if (!is_numeric($_user_id) || !is_numeric($_quantity) || !is_numeric($_price))
        {
            return false;
        }
        $db_result = app('db')->table('buy_order')
        ->insertGetId([
            'user_id'        => $_user_id,
            'order_price'    => $_price,
            'order_quantity' => $_quantity,
            'order_timestamp' => time()
        ]);
        return $db_result;
    }
 
    /**
     * [update description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function update(Request $_req)
    {
        if(!$_req->has('id') || !$_req->has('new_quantity') || !$_req->has('new_price'))
        {
            $response["status"]  = "false";
            $response["message"] = "please fill all required value";
            return response()->json($response);
        }
        $id  = $_req->input('id');
        $new_quantity = $_req->input('new_quantity');
        $new_price    = $_req->input('new_price');
        if($_req->has('hash'))
        {
            $hash          = $_req->input('hash');
            $method        = 'AES-256-CBC';
            $hex_key       = '65be329dece8d3c45849e350ee616d0c';
            $hex_iv        = '7286550e4c2fa1cea3106a17f1e228ed';
            $hash_to_json  = openssl_decrypt($hash, $method, hex2bin($hex_key), 0 , hex2bin($hex_iv));
            $json_to_array = json_decode($hash_to_json, true);

            if($json_to_array['user_id'] !== $id || $json_to_array['new_quantity'] !== $new_quantity || $json_to_array['new_price'
            ] !== $new_price)
            {
                $response["status"]  = "false";
                $response["message"] = "hash values has not equal to post values";
                return response()->json($response);
            }
        }

        $id = $this->db_update($id, $new_quantity, $new_price);

        $response["status"]  = "ok";
        $response["message"] = "buy_order updated with new id: ".$id;
        return response()->json($response);

    }

    /**
     * [db_update description]
     *
     * @param   [type]  $_id            [$_id description]
     * @param   [type]  $_new_quantity  [$_new_quantity description]
     * @param   [type]  $_new_price     [$_new_price description]
     *
     * @return  [type]                  [return description]
     */
    public function db_update($_id, $_new_quantity, $_new_price)
    {
        if (!is_numeric($_id) || !is_numeric($_new_quantity) || !is_numeric($_new_price))
        {
            return false;
        }
        $user_id = app('db')->table('buy_order')
            ->select('user_id')
            ->where('id', $_id)
            ->get();
        
        app('db')->table('buy_order')
            ->where('id', $_id)
            ->delete();

        $db_result = $this->db_set($user_id->all('user_id')[0]->user_id, $_new_quantity, $_new_price);
        return $db_result;
    }

}
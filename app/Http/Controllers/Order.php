<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class Order extends PositionLib
{

    /**
     * 
     *
     * @param   Request  $_req    = [
     *      
     *      sort_by* = quantity | price | id | timestamp
     *      limit (default = false)(disable = false)
     *      Desc  (default will ASC sort)
     * ]
     * @param   [type]   $_token  we need user_id from token to limit user access to database
     *
     * @return  [type]            [return description]
     */
    public function get(Request $_req, $_token)
    {
        $user_id            = $this->un_token($_token);
        if($user_id === false)
        {
            $response["status"]  = "false";
            $response["message"] = "Access denied";
            return response()->json($response);
        }
        $response           = [];
        $option             = [];
        $option['user']     = $user_id;
        $option['limit']    = ($_req->has('limit')) ? $_req->input('limit') : false;
        $option['Desc']     = ($_req->has('desc'))  ? "desc"                : 'asc';
        if($_req->has('sort_by')) 
        { 
            $option['sort_by']      = $_req->input('sort_by');
            $sortable_array         = ["quantity", "price", "id", "timestamp"];
            if (!in_array($option['sort_by'], $sortable_array))
            {
                $response["status"]  = "false";
                $response["message"] = "wrong sorty_by";
                return response()->json($response);
            }

            if($option['sort_by'] == "quantity")
            {
                $option['sort_by'] = "order_quantity";
            }
            elseif($option['sort_by'] == "price")
            {
                $option['sort_by'] = "order_price";
            }
            elseif($option['sort_by'] == "timestamp")
            {
                $option['sort_by'] = "order_timestamp";
            }
        } 
        else 
        {            
            $response["status"]  = "false";
            $response["message"] = "i can't find sort_by";
            return response()->json($response);
        }
        
        $data = $this->app_order_db($option);
        
        if ($data === false)
        {
            $response["status"]  = "false";
            $response["message"] = "wrong values";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"]   = $data;

        return response()->json($response);
    }

    /**
     * [app_order_db description]
     *
     * @param   [type]  $_option  = [limit, user, Desc, sort_by]
     *
     * @return  [type]            ["buy" => [], "sell" => []]
     */
    public function app_order_db($_option)
    {
        /**
         * 
         *
         * @var [type] db_resault [buy][] [sell][]
         */
        $finish_array = [];
        if(!is_array($_option) || !isset($_option["sort_by"]))
        {
            return false;
        }
        if($_option["limit"] == false)
        {
            $buy_result = app('db')->table('buy_order')
            ->select('id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            ->where('user_id', $_option['user'])
            ->orderBy($_option['sort_by'], $_option['Desc'])
            ->get()
            ->all();
            $sell_result = app('db')->table('sell_order')
            ->select('id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            ->where('user_id', $_option['user'])
            ->orderBy($_option['sort_by'], $_option['Desc'])
            ->get()
            ->all();
            
        }
        else
        {
            $buy_result = app('db')->table('buy_order')
            ->select('id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            ->where('user_id', $_option['user'])
            ->orderBy($_option['sort_by'], $_option['Desc'])
            ->get()
            ->all();
            $sell_result = app('db')->table('sell_order')
            ->select('id', 'order_quantity as quantity', 'order_price as price', 'order_timestamp as timestamp')
            ->where('user_id', $_option['user'])
            ->orderBy($_option['sort_by'], $_option['Desc'])
            ->limit($_option['limit'])
            ->get()
            ->all();
        }

        $finish_array["buy"]  = (array) $buy_result;
        $finish_array["sell"] = (array) $sell_result;
        return $finish_array;
    }


    /**
     * 
     *
     * @param   Request  $_req  = [limit, desc]
     *  desc means higher to lower
     * @return  [type]          [return description]
     */
    public function board(Request $_req)
    {
        $limit = ($_req->has('limit')) ? $_req->input('limit') : false;
        $sort  = ($_req->has('desc'))  ? "desc"                : 'asc';
        $data  = $this->db_board($sort);
        
        if ($data === false)
        {
            $response["status"]  = "false";
            $response["message"] = "wrong values";
            return response()->json($response);
        }

        $response["status"] = "ok";
        $response["data"]   = $this->ready_to_board($data);

        return response()->json($response);
    }

    /**
     * [searchForId description]
     *
     * @param   [type]  $price  [$price description]
     * @param   [type]  $array  [$array description]
     *
     * @return  [type]          [return description]
     */
    private function exsit_price($price, $array) 
    {
        foreach ($array as $key => $val) 
        {
            if ($val['price'] === $price) 
            {
                return $key;
            }
        }
        return null;
    }

    /**
     * [ready_to_board description]
     *
     * @param   [type]  $_array  [$_array description]
     *
     * @return  [type]           [return description]
     */
    public function ready_to_board($_array)
    {
        if(!is_array($_array))
        {
            return false;
        }
        $finish_array               = [];
        $finish_array["buy"]        = [];
        $finish_array["sell"]       = [];
        foreach($_array["buy"] as $key => $value)
        {
            $value = (array) $value;
            if(empty($finish_array))
            {
                array_push($finish_array["buy"], $value);
                continue;
            }
            $exist_price = $this->exsit_price($value["price"], $finish_array["buy"]);
            if($exist_price === null)
            {
                array_push($finish_array["buy"], $value);
                continue;
            }
            $finish_array["buy"][$exist_price]["price"] += $value["price"];
        }
        foreach($_array["sell"] as $key => $value)
        {
            $value = (array) $value;
            if(empty($finish_array))
            {
                array_push($finish_array["sell"], $value);
                continue;
            }
            $exist_price = $this->exsit_price($value["price"], $finish_array["sell"]);
            if($exist_price === null)
            {
                array_push($finish_array["sell"], $value);
                continue;
            }
            $finish_array["sell"][$exist_price]["price"] += $value["price"];
        }

        return $finish_array;
    }

    /**
     * [db_board description]
     *
     * @param   [type]  $sort  [$sort description]
     *
     * @return  [type]         [return description]
     */
    public function db_board($_sort)
    {
        /**
         * 
         *
         * @var [type] db_resault [buy][] [sell][]
         */
        $finish_array = [];

        $buy_result  = $this->all_order("buy", $sort);
        $sell_result = $this->all_order("sell", $sort);

        $finish_array["buy"]  = $buy_result;
        $finish_array["sell"] = $sell_result;
        return $finish_array;
    }


    /**
     * [set description]
     *
     * @param   Request  $_req    = ["price", "quantity", "type"]
     * @param   [type]   $_token   user token (made when login)
     *
     * @return  [type]            json response
     */
    public function set(Request $_req, $_token)
    {
        $user_id  = $this->un_token($_token);
        $response = [];
        if($user_id === false)
        {
            $response["status"]  = "false";
            $response["message"] = "Access denied";
            return response()->json($response);
        }
        if(!$_req->has("price") || !$_req->has("quantity") || !$_req->has("type"))
        {
            $response["status"]  = "false";
            $response["message"] = "please fill all require value";
            return response()->json($response);
        }

        $can_set_order = $this->can_set_this_order($user_id, $_req->input("price"), $_req->input("quantity"), $_req->input("type"));
        if(!$can_set_order)
        {
            $response["status"]  = "false";
            $response["message"] = "can't set this order";
            return response()->json($response);
        }

        $can_make_position = $this->can_make_position($_req->input("type"), $_req->input("price"), $_req->input("quantity"));
        if(!$can_make_position)
        {
            if(!$this->set_order($user_id, $_req->input("price"), $_req->input("type"), $_req->input("quantity")))
            {
                $response["status"] = "ok";
                $response["message"]   = "something is Wrong";
                
                return response()->json($response);
            }
            
            $response["status"] = "ok";
            $response["message"]   = "Successfully set order";
            
            return response()->json($response);
        }
        
        $position_data = [
            "user_id"  => $user_id,
            "quantity" => $_req->input("quantity"),
            "type"     => $_req->input("type"),
            "price"    => $_req->input("price")
        ];
        
        
        if(!$this->make_position($position_data, $can_make_position))
        {
            $response["status"]  = "false";
            $response["message"] = "something is Wrong";
        }
        
        $response["status"]  = "ok";
        $response["message"] = "Successfully set order";

        return response()->json($response);
    }

    public function set_order($_user_id, $_price, $_type, $_quantity)
    {
        if($_type != "sell" && $_type != "buy" || !is_numeric($_user_id) || !is_numeric($_quantity) || !is_numeric($_price))
        {
            return false;   
        }
        $table  = ($_type == "sell") ? 'sell_order'  : 'buy_order';
        app('db')->table($table)->insert(
            [
                'user_id'         => $_user_id,
                'order_price'     => $_price,
                'order_quantity'  => $_quantity,
                'order_timestamp' => time(),
            ]
        );

        return true;
    }

    public function can_set_this_order($_user_id, $_quantity, $_price, $_type)
    {
        if($_type != "sell" && $_type != "buy" || !is_numeric($_user_id) || !is_numeric($_quantity) || !is_numeric($_price))
        {
            return false;
        }
        $by_position = $this->check_by_position($_type, $_user_id, $_quantity, $_price);
        if($by_position === false)
        {
            var_dump("helo");
            return false;
        }
        if($by_position["can_use"] === true || $by_position["sureplus"] == 0)
        {
            return true;
        }
        
        $sureplus = (isset($by_position["surplus"])) ? $by_position["surplus"] : $_price * $_quantity;

        $by_user_credit = $this->check_by_user_credit($_type, $_user_id, $sureplus);

        return $by_user_credit;
    }
}
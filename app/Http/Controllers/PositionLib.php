<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class PositionLib extends Controller
{

    public function user_open_position($_type, $_user_id)
    {
        if($_type != "sell" && $_type != "buy" || !is_numeric($_user_id))
        {
            return false;
        }

        $positions = app("db")->table("position")
        ->select()
        ->where([
            ["user_id", "=", $_user_id],
            ["state", ">", 0]
        ])
        ->get()->all();

        return (array)$positions;
    }

    public function order_by_id($_id, $_type)
    {
        if($_type != "sell" && $_type != "buy")
        {
            return false;
        }
        $type  = ($_type == "sell") ? 'sell_order'  : 'buy_order';

        $result = app('db')->table($type)
        ->select()
        ->where("id", $_id)
        ->get()
        ->all();
        return (array)($result);
    }

    public function all_order($_type, $_sort)
    {
        if($_type != "sell" && $_type != "buy")
        {
            return false;
        }

        if($_type == "buy")
        {
            $result = app('db')->table('buy_order')
            ->select('id', 'order_quantity as quantity', 'order_price as price')
            ->orderBy('order_price', $_sort)
            ->get()
            ->all();
            return (array)($result);
        }
        $result = app('db')->table('sell_order')
        ->select('id', 'order_quantity as quantity', 'order_price as price')
        ->orderBy('order_price', $_sort)
        ->get()
        ->all();

        return (array)($result);
    }


    public function order_by_price($_type, $_price)
    {
        if($_type != "sell" && $_type != "buy")
        {
            return false;
        }
        $lower = ($_type == "sell") ? '>='          : '<=';
        $type  = ($_type == "sell") ? 'sell_order'  : 'buy_order';

        $result = app('db')->table($type)
        ->select()
        ->where("order_price", $lower , $_price)
        ->orderBy('order_timestamp', 'asc')
        ->get()
        ->all();
        return (array)($result);
    }

    private function order_cach($_type, $_user_id)
    {
        if($_type == "buy")
        {
            $buy_result = app('db')->table('buy_order')
            ->select()
            ->where('user_id', $_user_id)
            ->get()
            ->all();
            $res = (array)($buy_result);

            $sum_quantity = 0;
            foreach($res as $key => $value)
            {
                $value = (array)$value;
                $sum_quantity += $value["order_quantity"];
            }
            return $sum_quantity;
        }
        elseif($_type == "sell")
        {
            $sell_result = app('db')->table('sell_order')
            ->select()
            ->where('user_id', $_user_id)
            ->get()
            ->all();
            $res = (array)($sell_result);

            $sum_price = 0;
            foreach($res as $key => $value)
            {
                $sum_price += $value["order_price"] * $value["order_quantity"];
            }
            return $sum_price;
        }
        else
        {
            return false;
        }
    }


    public function check_by_position($_type, $_user_id, $_quantity, $_price)
    {

        if($_type != "sell" && $_type != "buy" || !is_numeric($_user_id) || !is_numeric($_quantity) || !is_numeric($_price))
        {
            return false;
        }

        /**
         * [
         *      can_use = (bool)
         *      sureplus = (int)
         * ]
         *
         * @var [type]
         */
        $final_array = [];

        $not_type = ($_type == "sell") ? "buy" : "sell";
        $positions = $this->user_open_position($not_type, $_user_id);
        if(!$positions || empty($positions))
        {
            return null;
        }

        /**
         * must check value... 
         */
        if($_type == "sell")
        {
            $sum_quantity = 0;
            $uses_quantity = $this->order_cach($not_type, $_user_id);
            if($uses_quantity === false)
            {
                return false;
            }
            foreach($positions as $key => $value)
            {
                $value = (array)$value;
                $sum_quantity += $value["position_quantity"];
            }
            if(($sum_quantity - $uses_quantity) === 0)
            {
                $final_array["can_use"] = false;
                return $final_array;
            }
            if(($sum_quantity - $uses_quantity) < $_quantity)
            {
                $final_array["can_use"]  = true;
                $final_array["sureplus"] = $_quantity - ($sum_quantity - $uses_quantity);
                return $final_array;
            }
            $final_array["can_use"]  = true;
            $final_array["sureplus"] = 0;
            return $final_array;
            
        }
        elseif($_type == "buy")
        {
            $sum_price = 0;
            $uses_price = $this->order_cach($not_type, $_user_id);
            if($uses_price === false)
            {
                return false;
            }
            foreach($positions as $key => $value)
            {
                $value = (array)$value;
                $sum_price += $value["position_price"] * $value["position_quantity"];
            }
            if(($sum_price - $uses_price) === 0)
            {
                $final_array["can_use"] = false;
                return $final_array;
            }
            if(($sum_price - $uses_price) < ($_quantity * $_price))
            {
                $final_array["can_use"]  = true;
                $final_array["sureplus"] = ($_quantity * $_price) - ($sum_price - $uses_price);
                return $final_array;
            }
            $final_array["can_use"]  = true;
            $final_array["sureplus"] = 0;
            return $final_array;
        }
        else 
        {
           return false;
        }

    }


    public function reduce_credit($_user_id)
    {
        // can't belive it's work ?
        app('db')->table('user')
            ->decrement('user_credit', 1, ["id" => $_user_id]);

        $result = app('db')->table('user')
        ->select("user_credit")
        ->where('user_id', $_user_id)
        ->get()
        ->all();
        $res = (array)($buy_result);
        $user_credit = $res[0]["user_credit"];
        return $user_credit;
    }

    public function increase_credit($_user_id)
    {
        // can't belive it's work ?
        app('db')->table('user')
            ->increment('user_credit', 1, ["id" => $_user_id]);

        $result = app('db')->table('user')
        ->select("user_credit")
        ->where('user_id', $_user_id)
        ->get()
        ->all();
        $res = (array)($buy_result);
        $user_credit = $res[0]["user_credit"];
        return $user_credit;
    }

 
    public function check_by_user_credit($_type, $_user_id, $_value)
    {
        if($_type != "sell" && $_type != "buy" || !is_numeric($_user_id) || !is_numeric($_value))
        {
            return false;
        }

        $result = app('db')->table('user')
        ->select("user_credit")
        ->where('user_id', $_user_id)
        ->get()
        ->all();
        $res = (array)($result);
        $user_credit = $res[0]["user_credit"];

        $new_credit = $this->reduce_credit($_user_id);
        
        if($new_credit >= 0)
        {
            return true;
        }
        else
        {
            $this->increase_credit($_user_id);
            return false;
        }
    }


    public function can_make_position($_type, $_price, $_quantity)
    {
        if($_type != "sell" && $_type != "buy" || !is_numeric($_quantity) || !is_numeric($_price))
        {
            return false;
        }
        $not_type = ($_type == "sell") ? "buy" : "sell";
        $more_order = $this->order_by_price($not_type, $_price);


        $orders       = [];
        $sum_quantity = 0;
        $quantity     = $_quantity;
        foreach($more_order as $key => $value)
        {
            $value = (array)$value;
            if($value["order_quantity"] <= $quantity)
            {
                $make_arr = [];
                $quantity -= $value["order_quantity"];

                $make_arr["order_id"]   = $value["id"];
                $make_arr["order_type"] = $not_type;
                $make_arr["surplus"]    = $quantity;

                array_push($orders, $make_arr);
                if(($value["order_quantity"] - $quantity) === 0)
                {
                    break;
                }
            }
        }
        if(empty($orders))
        {
            return false;
        }
        return $orders;
    }

    public function add_positon($_array)
    {
        if(!is_array($_array))
        {
            return false;
        }
        $new_pos_id = app('db')->table('position')->insertGetId(
            $_array
        );
        $this->do_match_position($new_pos_id, $_array);
    }

    public function state_update($_position_id, $_new_state, $_last_state = null, $_match_position_id = null)
    {
        app('db')->table('position')
            ->where('id', $_position_id)
            ->update(['state' => $_new_state]);
    
        if($_match_position_id !== null)
        {
            app('db')->table('offset')
            ->insert([
                'position1_id' => $_position_id,
                'position2_id' => $_match_position_id,
                'count' => ($_last_state - $_new_state),
            ]);
        }
        return true;
    }

    public function do_match_position($_position_id, $_array)
    {
        $not_type = ($_array["position_type"] == "sell") ? "buy" : "sell";
        $result = app('db')->table('position')
        ->select()
        ->where([
            ["user_id", "=", $_array["user_id"]],
            ["position_type", "=", $not_type],
            ["state", ">", 0],
        ])
        ->orderBy('position_timestamp', 'asc')
        ->get()
        ->all();
        $res = (array)($result); 

        $position_state = $_array["state"];
        foreach($res as $key => $value)
        {
            $value = (array)$value;
            if($position_state == 0)
            {
                break;
            }
            if($value["state"] > $position_state)
            {
                $new_state = $value["state"] - $position_state;
                $position_state = 0;
            }
            else
            {
                $new_state = 0;
                $position_state -= $value["state"];
            }
            $this->state_update($value['id'], $new_state, $value["state"], $_position_id);
        }
        $this->state_update($_position_id, $position_state);

        return true;
    }

    public function make_position($_position_array, $_match_order_array)
    {
        $array_of_positions = [];
        $not_type = ($_position_array["type"] == "sell") ? "buy" : "sell";
        foreach($_match_order_array as $key => $value)
        {
            $value = (array)$value;
            $this_order = $this->order_by_id($value["order_id"], $value["order_type"])[0];

            $tmp_arr1 = [
                "position_gain"           => null,
                "position_type"           => $_position_array["type"],
                "position_price"          => $this_order["order_price"],
                "position_quantity"       => ($_position_array["order_quantity"] - $this_order["surplus"]),
                "user_id"                 => $_position_array["user_id"],
                "corr_id"                 => $_this_order["user_id"],
                "position_timestamp	"     => time(),
                "position_old_timestamp	" => time(),
                "state"                   => ($_position_array["order_quantity"] - $this_order["surplus"]),
                
            ];
            $this->add_position($tmp_arr1);
            $tmp_arr1["order1"]= $_position_array["order_id"];
            $tmp_arr1["order2"]= $value["order_id"];

            $tmp_arr2 = [
                "position_gain"           => null,
                "position_type"           => $not_type,
                "position_price"          => $this_order["order_price"],
                "position_quantity"       => ($_position_array["order_quantity"] - $this_order["surplus"]),
                "corr_id"                 => $_position_array["user_id"],
                "user_id"                 => $_this_order["user_id"],
                "position_timestamp	"     => time(),
                "position_old_timestamp	" => $_this_order["order_timestamp"],
                "state"                   => ($_position_array["order_quantity"] - $this_order["surplus"]),
            ];
            $this->add_position($tmp_arr1);
            $tmp_arr1["order1"]= $_position_array["order_id"];
            $tmp_arr1["order2"]= $value["order_id"];
            
            array_push($array_of_positions, $tmp_arr1, $tmp_arr2);
        }
    }
}
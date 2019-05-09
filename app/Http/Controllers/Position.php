<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;


class Position extends Controller
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

        $data = $this->db_position($option);

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
     * [db_position description]
     *
     * @param   [type]  $_option  [$_option description]
     *
     * @return  [type]            [return description]
     */
    public function db_position($_option = [])
    {
        if ($_option['limit'] === null && $_option['Desc'] === null)
        {
            $db_result = app('db')->table('position')
                ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                ->get();
            }
        elseif($_option['limit'] !== null)
        {
            if($_option['Desc'] !== null)
            {
                $db_result = app('db')->table('position')
                    ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                    ->orderBy('id', 'desc')
                    ->limit($_option['limit'])
                    ->get();
            }
            else
            {
                $db_result = app('db')->table('position')
                    ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                    ->limit($_option['limit'])
                    ->get();

            }            
        }
        elseif($_option['Desc'] !== null)
        {
            $db_result = app('db')->table('position')
            ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
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
        $db_result = app('db')->table('position')
            ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
            ->where('position.id', $_id)
            ->get();
        return $db_result;
    }
    

    /**
     * [type description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function type(Request $_req)
    {
        $response = [];
        if (!$_req->has('type'))
        {
            $response["status"]  = "false";
            $response["message"] = "please enter type";
            return response()->json($response);
        }
        $type = $_req->input('type');
        if ($type !== 'buy' || $type !== 'sell')
        {
            $response["status"]  = "false";
            $response["message"] = "type must be 'buy' or 'sell'";
            return response()->json($response);
        }

        $option             = [];
        $option['limit']    = ($_req->has('limit')) ? $_req->input('limit') : null;
        $option['Desc']     = ($_req->has('desc'))  ? true                  : null;

        $data = $this->db_type($type, $option);
        
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
     * [db_type description]
     *
     * @param   [type]  $_type    [$_type description]
     * @param   [type]  $_option  [$_option description]
     *
     * @return  [type]            [return description]
     */
    public function db_type($_type, $_option = [])
    {
        if ($type !== 'buy' || $type !== 'sell')
        {
            return false;
        }
        if ($_option['limit'] === null && $_option['Desc'] === null)
        {
            $db_result = app('db')->table('position')
                ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                ->where('position.position_type', $_type)
                ->get();
            }
        elseif($_option['limit'] !== null)
        {
            if($_option['Desc'] !== null)
            {
                $db_result = app('db')->table('position')
                    ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                    ->where('position.position_type', $_type)
                    ->orderBy('id', 'desc')
                    ->limit($_option['limit'])
                    ->get();
            }
            else
            {
                $db_result = app('db')->table('position')
                    ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                    ->where('position.position_type', $_type)
                    ->limit($_option['limit'])
                    ->get();

            }            
        }
        elseif($_option['Desc'] !== null)
        {
            $db_result = app('db')->table('position')
            ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
            ->where('position.position_type', $_type)
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
     * [user description]
     *
     * @param   Request  $_req  [$_req description]
     *
     * @return  [type]          [return description]
     */
    public function user(Request $_req)
    {
        $response = [];
        if (!$_req->has('user_id') || !$_req->has('corr_id'))
        {
            $response["status"]  = "false";
            $response["message"] = "please enter user_id or corr_id";
            return response()->json($response);
        }
        $user_id    = ($_req->has('user_id')) ? $_req->input('user_id') : null;
        $corr_id    = ($_req->has('corr_id')) ? $_req->input('corr_id') : null;

        $option             = [];
        $option['limit']    = ($_req->has('limit')) ? $_req->input('limit') : null;
        $option['Desc']     = ($_req->has('desc'))  ? true                  : null;

        $data = $this->db_user($user_id, $corr_id, $option);
        
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
     * @param   [type]  $_type    [$_type description]
     * @param   [type]  $_option  [$_option description]
     *
     * @return  [type]            [return description]
     */
    public function db_user($_type, $_option = [])
    {
        if ($type !== 'buy' || $type !== 'sell')
        {
            return false;
        }
        if ($_option['limit'] === null && $_option['Desc'] === null)
        {
            $db_result = app('db')->table('position')
                ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                ->where('position.position_type', $_type)
                ->get();
            }
        elseif($_option['limit'] !== null)
        {
            if($_option['Desc'] !== null)
            {
                $db_result = app('db')->table('position')
                    ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                    ->where('position.position_type', $_type)
                    ->orderBy('id', 'desc')
                    ->limit($_option['limit'])
                    ->get();
            }
            else
            {
                $db_result = app('db')->table('position')
                    ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
                    ->where('position.position_type', $_type)
                    ->limit($_option['limit'])
                    ->get();

            }            
        }
        elseif($_option['Desc'] !== null)
        {
            $db_result = app('db')->table('position')
            ->select('id', 'user_id', 'corr_id', 'position_quantity as quantity', 'position_price as price', 'position_gain as gain', 'position_type as type','position_timestamp as timestamp', 'position_old_timestamp as old_timestamp')
            ->where('position.position_type', $_type)
            ->orderBy('id', 'desc')
            ->get();

        }
        else
        {
            return false;
        }
        return $db_result;

    }

    
    public function timestamp(Request $_req)
    {

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
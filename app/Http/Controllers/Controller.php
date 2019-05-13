<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $HASH_METHOD = 'AES-256-CBC';
    public $KEY         = 'f5eec7ed408c42c1e8dd1e313906efe5';
    public $IV          = 'aea45d7e27dab378b25b76e44a778199';
    
    /**
     * it's usefull...
     *
     * @param   [type]  $_data  [$_data description]
     *
     * @return  [type]          [return description]
     */
    public function un_hash($_data)
    {
        
        $data = base64_decode($_data);
        $json = openssl_decrypt($data, $this->HASH_METHOD, hex2bin($this->KEY), 0, hex2bin($this->IV));
        $data_array = json_decode($json,true);
        // var_dump($data_array);
        return $data_array;
    }

    /**
     * it's just a sample to know how must make an hash from a data
     *
     * @param   [type]  $_data  [$_data description]
     *
     * @return  [type]          [return description]
     */
    public function make_hash($_data)
    {

        $json = json_encode($_data);
        $data = openssl_encrypt($json, $this->HASH_METHOD, hex2bin($this->KEY), 0, hex2bin($this->IV));
        $hash = base64_encode($data);

        return $hash;
    }

    /**
     * will make a token for a user when login
     *
     * @param   [type]  $_user_id  [$_user_id description]
     *
     * @return  [type]             [return description]
     */
    public function make_token($_user_id)
    {
        $array = ["user_id"=>$_user_id,"time"=>time()];
        return $this->make_hash($array);
    }


    /**
     * we need user_id from token 
     *
     * @param   [type]  $_user_id  [$_user_id description]
     *
     * @return  [type]             [return description]
     */
    public function un_token($_token)
    {
        $array = $this->un_hash($_token);
        return $array["user_id"];
    }

}

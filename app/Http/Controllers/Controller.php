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
        $data_array = json_decode($json);

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
        $data = openssl_encrypt($data, $this->HASH_METHOD, hex2bin($this->KEY), 0, hex2bin($this->IV));
        $hash = base64_encode($data);

        return $hash;
    }
}

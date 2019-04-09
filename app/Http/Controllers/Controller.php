<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function get_sells($status)
    {
        /**
         * status must:
         * 1 - open
         * 2- closed
         * 3- removed
         * 4- edited
         * 5- rejected
         * 6- complete
         */
        $status_type = ["open", "closed", "removed", "edited", "rejected", "complete"];
        if (!in_array($status, $status_type))
        {
            return false;
        }
        $db_result = app('db')->table('sell')
            ->where('status', $status)
            ->join('user',"sell.seller_id",'=',"user.id")
            ->join('product',"sell.product_id",'=',"product.id")
            ->get();
        return $db_result;
    }
}

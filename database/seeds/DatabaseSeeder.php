<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->table('user')->insert([
            'user_name'  => "geeksesi",
            'user_email' => 'geeksesi@gmail.com',
            'user_phone' => '09100101543',
            'user_timestamp' => time(),
            ]);
            
        app('db')->table('user')->insert([
            'user_name'  => "javad",
            'user_email' => 'javad@gmail.com',
            'user_phone' => '09224501913',
            'user_timestamp' => time(),
        ]);

         
        app('db')->table('product')->insert([        
            'product_name'     => "قیر فرداعلاء",
        ]);

        app('db')->table('product_price')->insert([        
            'product_id'      => 1,
            'min_price'       => 155000,
            'max_price'       => 195000,
            'price'           => 185000,
            'price_timestamp' => time(),
            'price_status'    => 'available',
        ]);

        app('db')->table('sell')->insert([        
            'user_id'         => 1,
            'product_id'      => 1,
            'offer_value'     => 1,
            'offer_price'     => 156000,
            'offer_timestamp' => time(),
            'offer_status'    => "open",
        ]);

        app('db')->table('sell')->insert([        
            'user_id'         => 1,
            'product_id'      => 1,
            'offer_value'     => 1,
            'offer_price'     => 156000,
            'offer_timestamp' => time(),
            'transaction_id' => 1,
            'offer_status'    => "complete",
        ]);

        app('db')->table('transaction')->insert([
            'product_id' => 1,
            'seller_id' => 1,
            'buyer_id' => 2,
            'offer_id' => 2,
            'offer_type' => 1,
            'transaction_value' => 1,
            'transaction_price' => 1,
            'transaction_status' => "complete",
            'transaction_timestamp' => time(),
        ]);
        
        app('db')->table('transaction')->insert([
            'product_id' => 1,
            'seller_id' => 1,
            'buyer_id' => 2,
            'offer_id' => 2,
            'offer_type' => 2,
            'transaction_value' => 1,
            'transaction_price' => 1,
            'transaction_status' => "complete",
            'transaction_timestamp' => time(),
        ]);
        
        
        app('db')->table('buy')->insert([        
            'user_id'         => 1,
            'product_id'      => 1,
            'offer_value'     => 1,
            'offer_price'     => 156000,
            'offer_timestamp' => time(),
            'offer_status'    => "open",
        ]);

        app('db')->table('buy')->insert([        
            'user_id'         => 1,
            'product_id'      => 1,
            'offer_value'     => 1,
            'offer_price'     => 156000,
            'offer_timestamp' => time(),
            'transaction_id' => 2,
            'offer_status'    => "complete",
        ]);

    }
}

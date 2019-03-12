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
            'name'  => "geeksesi",
            'email' => 'geeksesi@gmail.com',
            'phone' => '09100101543',
        ]);

        app('db')->table('user')->insert([
            'name'  => "javad",
            'email' => 'javad@gmail.com',
            'phone' => '09224501913',
        ]);

        app('db')->table('product_price')->insert([        
            'product_id' => 1,
            'min_price'  => 155000,
            'max_price'  => 195000,
            'price'      => 185000,
            'time'       => time(),
        ]);
        
        app('db')->table('product')->insert([        
            'name'     => "قیر فرداعلاء",
            'price_id' => 1,
        ]);
        
        app('db')->table('sell')->insert([        
            'seller_id'  => 1,
            'product_id' => 1,
            'value'      => 1,
            'price'      => 156000,
            'time'       => time(),
            'status'     => "open",
        ]);

        app('db')->table('sell')->insert([        
            'seller_id'  => 1,
            'product_id' => 1,
            'value'      => 2,
            'price'      => 320000,
            'time'       => time(),
            'status'     => "complete",
        ]);

        app('db')->table('buy')->insert([        
            'seller_id'  => 1,
            'buyer_id'   => 2,
            'product_id' => 1,
            'sell_id' => 2,
            'value'      => 2,
            'price'      => 321000,
            'time'       => time(),
            'status'     => "complete",
        ]);
                        

    }
}

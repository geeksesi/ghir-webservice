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
            'user_status'  => "idk",
            'name'         => 'mohammad javad ghasemy laylaylay',
            'user_name'    => 'geeksesei',
            'phone_number' => '09100101543',
            'password'     => password_hash('javadkhof',PASSWORD_DEFAULT),
            'account_id'   => 1,
            'user_credit'  => 12.5,
        ]);
        
        app('db')->table('user')->insert([
            'user_status'  => "idk",
            'name'         => 'ali skldhflasd skkdjlfha sldfsdf',
            'user_name'    => 'javadkhof',
            'phone_number' => '09224501913',
            'password'     => password_hash('geeksesi',PASSWORD_DEFAULT),
            'account_id'   => 2,
            'user_credit'  => 2.5,
        ]);
            


        app('db')->table('sell_order')->insert([        
            'user_id'         => 1,
            'order_quantity'  => 1,
            'order_price'     => 156000,
            'order_timestamp' => time(),
        ]);

        app('db')->table('sell_order')->insert([        
            'user_id'         => 2,
            'order_quantity'  => 123,
            'order_price'     => 56565468,
            'order_timestamp' => time(),
        ]);

        app('db')->table('buy_order')->insert([        
            'user_id'         => 1,
            'order_quantity'  => 1,
            'order_price'     => 156000,
            'order_timestamp' => time(),
        ]);

        app('db')->table('buy_order')->insert([        
            'user_id'         => 2,
            'order_quantity'  => 123,
            'order_price'     => 56565468,
            'order_timestamp' => time(),
        ]);

        app('db')->table('position')->insert([        
            'user_id'                => 2,
            'corr_id'                => 1,
            'position_gain'          => 123,
            'position_type'          => 123,
            'position_quantity'      => 123,
            'position_price'         => 56565468,
            'position_timestamp'     => time(),
            'position_old_timestamp' => time() - 500,
            'state'                  => "123",
        ]);
            
        app('db')->table('position')->insert([        
            'user_id'                => 1,
            'corr_id'                => 2,
            'position_gain'          => 123,
            'position_type'          => 123,
            'position_quantity'      => 123,
            'position_price'         => 56565468,
            'position_timestamp'     => time(),
            'position_old_timestamp' => time() - 500,
            'state'                  => "123",
        ]);

        app('db')->table('offset')->insert([        
            'position1_id' => 1,
            'position2_id' => 2,
            'count'        => 10,
        ]);
      
      
      
        app('db')->table('account')->insert([        
            'owner_id' => 1,
            'bank'     => '13546846513',
            'sheba'    => 'IR5125457215665',
        ]);


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('currencies')->insert([
            [
                'code'=>'USD',
                'name'=>'US Dollar',
                'symbol'=>'$',
                'normal_val'=>'1105.00',
                'us_value'=>'1',
                'status'=>'1',
                'user_id'=>'1',
                'fr_use_status'=>'0'
            ],
            [
                'code'=>'EUR',
                'name'=>'EURO',
                'symbol'=>'€',
                'normal_val'=>'1204.07',
                'us_value'=>'1.09',
                'status'=>'1',
                'user_id'=>'1',
                'fr_use_status'=>'0'
            ],
            [
                'code'=>'GBP',
                'name'=>'Pound Sterling',
                'symbol'=>'£',
                'normal_val'=>'1371.05',
                'us_value'=>'1.25',
                'status'=>'1',
                'user_id'=>'1',
                'fr_use_status'=>'0'
            ],
            [
                'code'=>'RWF',
                'name'=>'Rwanda Franc',
                'symbol'=>'₣',
                'normal_val'=>'1',
                'us_value'=>'0.00090',
                'status'=>'1',
                'user_id'=>'1',
                'fr_use_status'=>'1'
            ],
        ]);

    }
}


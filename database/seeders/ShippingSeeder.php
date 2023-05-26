<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
          [
            'shipping_method'=>'Free Shipping',
            'value'=>'0',
            'status'=>'1',
          ],
          [
            'shipping_method'=>'Standard',
            'value'=>'10',
            'status'=>'0',
          ],
        ]);
    }
}

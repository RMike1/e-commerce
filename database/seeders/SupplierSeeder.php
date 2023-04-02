<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
         [
            'first_name'=>'Kalisa',
            'second_name'=>'James',
            'status'=>'1',
         ],
         [
            'first_name'=>'Shami',
            'second_name'=>'Fabrice',
            'status'=>'2',
         ]
        ]);
    }
}

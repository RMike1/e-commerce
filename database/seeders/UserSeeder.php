<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name'=>'sam',
            'email'=>'sam@gmail.com',
            'password'=>hash::make('1234'),
            'usertype'=>'0',
            'currency_id'=>'1',
            'shipping_id'=>'1'
            ],
            [
            'name'=>'agent',
            'email'=>'agent@gmail.com',
            'password'=>hash::make('1234'),
            'usertype'=>'1',
            'currency_id'=>'1',
            'shipping_id'=>'1'
            ],
            [
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>hash::make('1234'),
            'usertype'=>'2',
            'currency_id'=>'1',
            'shipping_id'=>'1'
            ],

        ]);
    }
}

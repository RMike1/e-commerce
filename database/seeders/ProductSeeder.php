<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
            'product_name'=>'PHP',
            'product_price'=>'2000000',
            'product_quantity'=>'2000',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'1',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/img_la_1678873640.jpg',
            'category_id'=>'1',
            'supplier_id'=>'1',
            ],
            [
            'product_name'=>'HTML/CSS',
            'product_price'=>'1000000',
            'product_quantity'=>'300',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'1',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'1',
            'supplier_id'=>'1',
            ],
        ]);
    }
}

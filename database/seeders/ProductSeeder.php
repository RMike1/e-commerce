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
            'product_name'=>'Dell',
            'product_price'=>'2000000',
            'product_quantity'=>'2000',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'1',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'1',
            'supplier_id'=>'1',
            ],
            [
            'product_name'=>'HP',
            'product_price'=>'1000000',
            'product_quantity'=>'0',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'1',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'1',
            'supplier_id'=>'2',
            ],
            [
            'product_name'=>'Iphone 12',
            'product_price'=>'2000000',
            'product_quantity'=>'400',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'2',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'2',
            'supplier_id'=>'2',
            ],
            [
            'product_name'=>'Samsung edge 6+',
            'product_price'=>'1000000',
            'product_quantity'=>'340',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'1',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'2',
            'supplier_id'=>'1',
            ],
            [
            'product_name'=>'Tecno Camon 11',
            'product_price'=>'2000000',
            'product_quantity'=>'340',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'3',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'2',
            'supplier_id'=>'1',
            ],
            [
            'product_name'=>'LG',
            'product_price'=>'3000000',
            'product_quantity'=>'540',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'0',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'3',
            'supplier_id'=>'2',
            ],
            [
            'product_name'=>'Samsung',
            'product_price'=>'6000000',
            'product_quantity'=>'540',
            'product_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus ex eaque nulla, rem dignissimos laborum exercitationem sunt sint? Culpa obcaecati autem et. Distinctio, dolore. Voluptatibus cumque maxime impedit laudantium quos.',
            'product_status'=>'2',
            'product_publish'=>'1',
            'product_image'=>'storage/uploads/matt-bluejay-In3VT75Nb2A-unsplash_1678873285.jpg',
            'category_id'=>'3',
            'supplier_id'=>'1',
            ],
        ]);
    }
}

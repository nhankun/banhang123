<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('categories')->insert([
            [
                'id'=>1,
                'name'=>'Phone',
                'icon' => 'images/icon_phone.png',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>2,
                'name'=>'Laptop',
                'icon' => 'images/laptop.png',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>3,
                'name'=>'Iphone',
                'icon' => 'images/icon_phone.png',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>4,
                'name'=>'Ipad',
                'icon' => 'images/ipad.png',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyDefaultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('property_defaults')->insert([
            [
                'id'=>1,
                'category_id'=>1,
                'name'=>'Màn hình',
                'sort'=>1,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>2,
                'category_id'=>1,
                'name'=>'Camera trước',
                'sort'=>2,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>3,
                'category_id'=>1,
                'name'=>'Camera sau',
                'sort'=>3,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>4,
                'category_id'=>1,
                'name'=>'Ram',
                'sort'=>4,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>5,
                'category_id'=>1,
                'name'=>'Bộ nhớ trong',
                'sort'=>5,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>6,
                'category_id'=>1,
                'name'=>'CPU',
                'sort'=>6,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>7,
                'category_id'=>1,
                'name'=>'GPU',
                'sort'=>7,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>8,
                'category_id'=>1,
                'name'=>'Dung lượng PIN',
                'sort'=>8,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>9,
                'category_id'=>1,
                'name'=>'Hệ điều hành',
                'sort'=>9,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>10,
                'category_id'=>1,
                'name'=>'Sim',
                'sort'=>10,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
        ]);
    }
}

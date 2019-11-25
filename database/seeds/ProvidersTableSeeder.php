<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('providers')->insert([
            [
                'id'=>1,
                'name'=>'Asus',
                'image'=>'uploads/defaults/providers/images/asusLogo.png',
                'address'=>'Đài Loan',
                'email'=>'asus@asus.com',
                'tel'=> '18006588',
                'website'=>'https://www.asus.com/vn/',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>2,
                'name'=>'Dell',
                'image'=>'uploads/defaults/providers/images/dellLogo.png',
                'address'=>'Mỹ',
                'email'=>'dell@dell.com',
                'tel'=> '842838221366',
                'website'=>'http://www1.ap.dell.com/content/default.aspx?c=vn&l=en&s=&s=gen&~ck=cr',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
            [
                'id'=>3,
                'name'=>'HP',
                'image'=>'uploads/defaults/providers/images/hpLogo.png',
                'address'=>'Đài Loan',
                'email'=>'cskh@hp.com',
                'tel'=> '1800588868',
                'website'=>'https://www8.hp.com/vn/vi/products/laptops-tablets.html',
                'status'=>true,
                'created_at'=>$currentTime,
                'updated_at'=>$currentTime
            ],
        ]);
    }
}

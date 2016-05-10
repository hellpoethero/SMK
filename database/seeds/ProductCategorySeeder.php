<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Category_1')->insert([
            [
                'name' => 'Thời trang'
            ],[
                'name' => 'Đồ gia dụng'
            ]
        ]);
        DB::table('Category_2')->insert([
            [
                'name' => 'Thoi trang nam',
                'parent' => 1
            ],[
                'name' => 'Thoi trang nữ',
                'parent' => 1
            ]
        ]);
        DB::table('Category_3')->insert([
            [
                'name' => 'Giày da',
                'parent' => 1
            ],[
                'name' => 'Giày lười',
                'parent' => 1
            ]
        ]);
    }
}

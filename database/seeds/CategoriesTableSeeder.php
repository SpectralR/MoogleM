<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'cat 1'
        ]);

        DB::table('categories')->insert([
            'name' => 'cat 2'
        ]);

        DB::table('categories')->insert([
            'name' => 'cat 3'
        ]);

        DB::table('categories')->insert([
            'name' => 'cat 4'
        ]);
    }
}

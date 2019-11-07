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
            'name' => 'Presentation'
        ]);

        DB::table('categories')->insert([
            'name' => 'Help'
        ]);

        DB::table('categories')->insert([
            'name' => 'True End-game'
        ]);

        DB::table('categories')->insert([
            'name' => 'Raiding'
        ]);
    }
}

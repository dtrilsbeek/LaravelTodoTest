<?php

use App\TodoItem;
use Illuminate\Database\Seeder;

class TodoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TodoItem::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 15; $i++) {
            TodoItem::create([
                'title' => $faker->sentence,
                'body'=> $faker->paragraph,
            ]);
        }
    }
}

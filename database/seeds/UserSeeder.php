<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('dion');

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>$password,
            ]);
        }
    }
}

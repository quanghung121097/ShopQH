<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0 ; $i < 20; $i++){
            \DB::table('users')->insert([
                'password' => bcrypt('12345678'),
                'name'  => $faker->text(20),
                'email' => $faker->unique()->safeEmail,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'remember_token' => $faker->text(6),

            ]);
        }
    }
}

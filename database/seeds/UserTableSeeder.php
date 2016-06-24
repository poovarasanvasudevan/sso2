<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        for($i=0;$i<1000;$i++) {
            $user = new \App\User();
            $user->name = $faker->name;
            $user->email=$faker->email;
            $user->password=$faker->firstNameFemale;
            $user->avatar = $faker->imageUrl();
            $user->save();
        }
    }
}

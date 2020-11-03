<?php

use Illuminate\Database\Seeder;

# php artisan db:seed --class=UserSeeder

class UserSeeder extends Seeder {

    public
    function run() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker\Factory::create();

        $peran = ['dpc','relawan','saksi','paslon'];

        for ($h=0; $h < count($peran); $h++) { 

            for ($i=0; $i < 2; $i++) { 

                # code...
                $startDate = new Carbon\Carbon('first day of October'); //date("Y-m-d 00:00:00");
                $endDate = new Carbon\Carbon("today");
                $randomDate = Carbon\Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('Y-m-d h:i:s');

                $generated = [
                    // 'uuid'              => $faker->uuid,
                    'username'          => $peran[$h].$i,
                    'nama'              => $faker->name,
                    'telepon'           => $faker->e164PhoneNumber,
                    'whatsapp'          => $faker->e164PhoneNumber,
                    'password'          => bcrypt(123),
                    'password_plain'    => 123,
                    'peran'             => $peran[$h],
                    'created_at'        => $randomDate,
                ];

                var_dump($generated);

                DB::table('users')->insert($generated);
            }
        }
    }
}

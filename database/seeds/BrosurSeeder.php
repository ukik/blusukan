<?php

use Illuminate\Database\Seeder;

# php artisan db:seed --class=BrosurSeeder

class BrosurSeeder extends Seeder {

    public
    function run() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('brosur')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker\Factory::create();



        for ($h=0; $h < 10; $h++) { 
            # code...
            for ($i=0; $i < 500; $i++) { 

                # code...
                $startDate = Carbon\Carbon::now()->subDays($h); //date("Y-m-d 00:00:00");
                $endDate = new Carbon\Carbon("today");
                $randomDate = Carbon\Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('Y-m-d h:i:s');

                $generated = [
                    'uuid'                  => $faker->uuid,                
                    'user_uuid'             => mt_rand(1,8),
                    'alamat_jalan'          => $faker->streetAddress,
                    'alamat_nomor'          => mt_rand(1,100),
                    'alamat_rt'             => mt_rand(1,100),
                    'alamat_rw'             => mt_rand(1,100),
                    'alamat_kelurahan'      => $faker->city,
                    'alamat_kecamatan'      => $faker->country,
                    'catatan'               => $faker->text($maxNbChars = mt_rand(5, 100)), 
                    'lat'                   => $faker->latitude($min = -0.4551086, $max = -0.5411126),
                    'lang'                  => $faker->longitude($min = 117.0779573, $max = 117.1804393),
                    'brosur_kondisi'        => mt_rand(1,4),
                    'brosur_respon'         => mt_rand(1,4),      

                    'created_at'            => $randomDate,      
                ];

                var_dump($generated);

                DB::table('brosur')->insert($generated);
            }
        }
    }
}

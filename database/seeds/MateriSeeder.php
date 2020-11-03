<?php

use Illuminate\Database\Seeder;

# php artisan db:seed --class=MateriSeeder

class MateriSeeder extends Seeder {

    public
    function run() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('materi')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker\Factory::create();

        for ($i=0; $i < 50; $i++) { 

            # code...
            $startDate = Carbon\Carbon::now()->subDays(1); //new Carbon\Carbon('first day of October'); //date("Y-m-d 00:00:00");
            $endDate = new Carbon\Carbon("today");
            $randomDate = Carbon\Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('Y-m-d h:i:s');

            $generated = [
                // 'uuid'              => $faker->uuid,
                'gambar'            => $faker->imageUrl(mt_rand(400,800), mt_rand(400,800)),
                'dilihat'           => $faker->randomDigit,
                'created_at'        => $randomDate,
            ];

            var_dump($generated);

            DB::table('materi')->insert($generated);
        }
    }
}

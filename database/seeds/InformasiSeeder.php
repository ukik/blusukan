<?php

use Illuminate\Database\Seeder;

# php artisan db:seed --class=InformasiSeeder

class InformasiSeeder extends Seeder {

    public
    function run() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('informasi')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker\Factory::create();

        $judul = [
            'Tentang Paslon',
            'Visi & Misi',
            'Program Unggulan',
            'Ketentuan Sosialisasi',
            'Syarat Relawan & Saksi',
            'Peraturan Pokok KPU',
            'Disclaimer Kami',
        ];

        for ($i=0; $i < count($judul); $i++) { 

            # code...
            $startDate = Carbon\Carbon::now()->subDays(1); //new Carbon\Carbon('first day of October'); //date("Y-m-d 00:00:00");
            $endDate = new Carbon\Carbon("today");
            $randomDate = Carbon\Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('Y-m-d h:i:s');

            $generated = [
                // 'uuid'              => $faker->uuid,
                'judul'             => $judul[$i],
                'deskripsi'         => $faker->text($maxNbChars = 500), 
                'gambar'            => $faker->imageUrl(500, 800, 'cats'),
                'dilihat'           => $faker->randomDigit,
                'created_at'        => $randomDate,
            ];

            var_dump($generated);

            DB::table('informasi')->insert($generated);
        }
    }
}

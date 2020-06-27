<?php

use Illuminate\Database\Seeder;
use App\ModelPasien;
use App\ModelDoctor;
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); //import library faker

        $limit = 8; //batasan berapa banyak data

        $pasien = ModelPasien::all()->pluck('id_pasien');
        $doctor = ModelDoctor::all()->pluck('id_doctor');
        for ($i = 0; $i < $limit; $i++) {
            DB::table('appointments')->insert([ //mengisi datadi database
                'id_pasien' => $faker->randomElement($pasien),
                'id_doctor' => $faker->randomElement($doctor),
                'tanggal_janji' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
                'keterangan' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}

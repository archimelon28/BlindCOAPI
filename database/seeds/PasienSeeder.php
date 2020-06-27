<?php

use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
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

        $gender = $faker->randomElement(['L','P']);

        for ($i = 0; $i < $limit; $i++) {
            DB::table('pasien')->insert([ //mengisi datadi database
                'nama_pasien' => $faker->name,
                'alamat' => $faker->address,
                'jenis_kelamin' => $gender,
                'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'foto' => $faker->image('public\assets\images',640,480, false),
                'email' => $faker->unique()->safeEmail, //email unique sehingga tidak ada yang sama
                'password' => bcrypt('secret'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}

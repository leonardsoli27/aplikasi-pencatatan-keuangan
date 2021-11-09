<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableKaryawan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 2; $i++) {
            $data[$i] = [
                'nama_karyawan' => $faker->name,
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'nama_kelompok' => 'howe.adeline'
            ];
        }
        DB::table('karyawan')->insert($data);

        for ($i = 0; $i < 2; $i++) {
            $data1[$i] = [
                'nama_karyawan' => $faker->name,
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'nama_kelompok' => 'nader.vernie'
            ];
        }
        DB::table('karyawan')->insert($data1);
    }
}

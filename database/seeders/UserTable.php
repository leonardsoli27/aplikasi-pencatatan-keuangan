<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [];

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $data[$i] = [
                'kode_kelompok' => $faker->unique()->userName,
                'nama_kelompok' => $faker->name,
                'password' => bcrypt('123'),
                'remember_token' => \Str::random(10),
            ];
        }
        DB::table('users')->insert($data);

        DB::table('users')->insert([
            'kode_kelompok' => 'admin',
            'password' => bcrypt('12345'),
            'nama_kelompok' => 'Admin',
            'remember_token' => \Str::random(10),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablePengeluaran extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $user = DB::table('users')->get();
        for ($i = 0; $i < 5; $i++) {
            $data[$i] = [
                'kode_kelompok' => $user[$i]->kode_kelompok,
                'keterangan' => $faker->name,
                'kategori' => 'Operasional',
                'biaya_iklan' => 0,
                'pajak_iklan' => 0,
                'total' => $faker->numberBetween(20000, 50000),
                'tgl_pengeluaran' =>  $faker->dateTimeThisCentury()->format('Y-m-d')
            ];
        }
        DB::table('pengeluaran')->insert($data);

        for ($i = 0; $i < 5; $i++) {
            $data[$i] = [
                'kode_kelompok' => $user[$i]->kode_kelompok,
                'keterangan' => $faker->name,
                'kategori' => 'Iklan',
                'biaya_iklan' => $faker->numberBetween(20000, 50000),
                'pajak_iklan' => $faker->numberBetween(20000, 50000),
                'total' => $faker->numberBetween(20000, 50000),
                'tgl_pengeluaran' =>  $faker->dateTimeThisCentury()->format('Y-m-d')
            ];
        }
        DB::table('pengeluaran')->insert($data);
    }
}

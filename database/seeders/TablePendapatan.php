<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\FileIterator\Factory;

class TablePendapatan extends Seeder
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
                'nama_pembeli' => $faker->name,
                'nama_produk' => $faker->name,
                'jml_produk' => $faker->numberBetween(20, 40),
                'kas_masuk' => $faker->numberBetween(25000, 40000),
                'kas_keluar' => $faker->numberBetween(25000, 40000),
                'total' => $faker->numberBetween(5000, 40000),
                'jenis_pembayaran' => 'COD',
                'tgl_masuk' => $faker->dateTimeThisCentury()->format('Y-m-d'),
                'no_resi' => $faker->creditCardNumber(),
            ];
        }
        DB::table('pendapatan')->insert($data);

        for ($i = 0; $i < 5; $i++) {
            $data1[$i] = [
                'kode_kelompok' => $user[$i]->kode_kelompok,
                'nama_pembeli' => $faker->name,
                'nama_produk' => $faker->name,
                'jml_produk' => $faker->numberBetween(20, 40),
                'kas_masuk' => $faker->numberBetween(25000, 40000),
                'kas_keluar' => $faker->numberBetween(25000, 40000),
                'total' => $faker->numberBetween(5000, 40000),
                'jenis_pembayaran' => 'Transfer',
                'tgl_masuk' => $faker->dateTimeThisCentury()->format('Y-m-d'),
                'no_resi' => $faker->creditCardNumber(),
            ];
        }
        DB::table('pendapatan')->insert($data1);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Kelas_diikutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idpelatihan = [
            1,2,3,3,4,
        ];
        $nomor_peserta = [
            "01010001",
            "01010001",
            "01010002",
            "01010002",
            "01010002"
        ];


        

        for ($i = 0; $i < 4; $i++) {
            DB::table('kelas_diikuti')->insert([
                'idpelatihan' => $idpelatihan[$i],
                'nomor_peserta' =>$nomor_peserta[$i],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idPeriode = [
            1,2,2,3,4,
        ];
        $id_peserta = [
            1,
            1,
            2,
            2,
            2
        ];


        

        for ($i = 0; $i < 5; $i++) {
            DB::table('laporan')->insert([
                'idPeriode' => $idPeriode[$i],
                'id_peserta' =>$id_peserta[$i],
                'evaluasi' => ''
            ]);
        }
    }
}

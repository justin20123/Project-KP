<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PeriodeSeeder extends Seeder
{
    /**s
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tanggal_start= [
            "2023-09-01",
            "2023-09-08",
            "2023-09-15",
            "2023-09-22",
            "2023-09-29",
        ];
        $jenis_pelatihan =[
            'private',
            'private',
            'private',
            'kelompok',
            'kelompok',
        ];
        $status =[
            'berjalan',
            'berjalan',
            'berjalan',
            'berjalan',
            'berjalan',
        ];
        $jadwal = [
            "Senin,09.00-12.00",
            "Senin,13.00-15.00",
            "Selasa,09.00-12.00",
            "Selasa,13.00-15.00",
            "Rabu,09.00-12.00"
        ];
        $kelas_paralel = [
            "A", "A", "B", "A", "A"
        ];
        $idpelatihan = [
            1,2,2,3,4,
        ];
        $id_pengajar = [
            3,
            3,
            3,
            4,
            4
        ];


        

        for ($i = 0; $i < 5; $i++) {
            DB::table('periode')->insert([
                'tanggal_start' => $tanggal_start[$i],
                'status' => $status[$i],
                'jenis_pelatihan' => $jenis_pelatihan[$i],
                'jadwal' => $jadwal[$i],
                'kelas_paralel' => $kelas_paralel[$i],
                'idpelatihan' => $idpelatihan[$i],
                'id_pengajar' =>$id_pengajar[$i],
            ]);
        }
    }
}



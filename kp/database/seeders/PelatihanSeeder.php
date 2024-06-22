<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama = [
            "Akuntansi",
            "Dasar Pemrograman",
            "Psikologi Dewasa",
            "Hukum Pidana",
            "Bisnis Keuangan"
        ];


        $jadwal_pelatihan = [
            "Senin,09.00-12.00",
            "Senin,13.00-15.00",
            "Selasa,09.00-12.00",
            "Selasa,13.00-15.00",
            "Rabu,09.00-12.00"
        ];
        
        $nomor_pengajar = [
            "020001",
            "020001",
            "020001",
            "020002",
            "020002"
        ];

        for ($i = 0; $i < 4; $i++) {
            DB::table('pelatihan')->insert([
                'nama' => $nama[$i],
                'jadwal_pelatihan' =>$jadwal_pelatihan[$i],
                'nomor_pengajar' => $nomor_pengajar[$i],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomor = [
            "01010001",
            "01010002",
            "01020001",
            "01020002",
            "02010001"
        ];

        $nama = [
            "Yanta",
            "Yanti",
            "Yantu",
            "Yante",
            "Yanto"
        ];

        $alamat = [
            "Jl. Merdeka No. 9, Jakarta",
            "Jl. Sudirman No. 15, Bandung",
            "Jl. A. Yani No. 2, Surabaya",
            "Jl. Pahlawan No. 42, Yogyakarta",
            "Jl. Ahmad Dahlan No. 3, Semarang"
        ];

        $email = [
            "yanta@email.com",
            "yanti@email.com",
            "yantu@email.com",
            "yante@email.com",
            "yanto@email.com"
        ];

        $umur = [21,11,29,30,25];
        $tanggal_lahir = [
            "2003-01-01",
            "2013-01-01",
            "1995-01-01",
            "1994-01-01",
            "1999-01-01"
        ];


        for ($i = 0; $i < 4; $i++) {
            DB::table('peserta')->insert([
                // 'name' => $name[$i],
                'nomor' => $nomor[$i],
                'nama' => $nama[$i],
                'alamat' => $alamat[$i],
                'email' => $email[$i],
                'umur' => $umur[$i],
                'tanggal_lahir' => $tanggal_lahir[$i],
            ]);
        }
    }
}

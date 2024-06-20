<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = [
            "12345678",
            "12345678",
            "12345678",
            "12345678",
            "12345678"
        ];


        $nama = [
            "Yanta pengurus",
            "Yanti pengurus",
            "Yantu pengurus",
            "Yante pengurus",
            "Yanto pengurus"
        ];
        
        $alamat = [
            "Jl. Merdeka No. 9, Jakarta",
            "Jl. Sudirman No. 15, Bandung",
            "Jl. A. Yani No. 2, Surabaya",
            "Jl. Pahlawan No. 42, Yogyakarta",
            "Jl. Ahmad Dahlan No. 3, Semarang"
        ];

        $email = [
            "yantaurus@email.com",
            "yantiurus@email.com",
            "yantuurus@email.com",
            "yanteurus@email.com",
            "yantourus@email.com"
        ];

        $umur = [21,11,29,30,25];
        $tanggal_lahir = [
            "2003-01-01",
            "2013-01-01",
            "1995-01-01",
            "1994-01-01",
            "1999-01-01"
        ];
        $role = [
            "pengajar",
            "pengajar",
            "pengajar",
            "admin",
            "admin",
        ];


        for ($i = 0; $i < 4; $i++) {
            DB::table('pengurus')->insert([
                'nama' => $nama[$i],
                'password' => $password[$i],
                'alamat' => $alamat[$i],
                'email' => $email[$i],
                'umur' => $umur[$i],
                'tanggal_lahir' => $tanggal_lahir[$i],
                'role' => $role[$i],
            ]);
        }
    }
}

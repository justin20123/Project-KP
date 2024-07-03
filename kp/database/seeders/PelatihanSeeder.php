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
        
        $deskripsi = [
            "Akuntansi adalah ilmu yang mempelajari tentang pencatatan, pengol",
            "Dasar Pemrograman adalah ilmu yang mempelajari tentang cara menggunakan bahasa pemrograman untuk menciptakan program komputer yang dapat bekerja dan berperilaku yang tepat.",
            "Psikologi Dewasa adalah ilmu yang menggunakan teori dan metodologi yang berfokus pada perilaku, kebebasan, dan pengaruh psikologis di dalam",
            "Hukum Pidana adalah ilmu yang menggunakan teori dan metodologi yang berfokus pada penyelesaian masalah-masalah yang terjadi di dalam perkawinan, keluarga, dan negara.",
            "Bisnis Keuangan adalah ilmu yang menggunakan teori dan metodologi yang berfokus pada pencatatan, pengolahan, dan analisis ke"
        ];

        $jumlah_pertemuan = [
            6,8,4,9,10
        ];
        
    

        for ($i = 0; $i < 5; $i++) {
            DB::table('pelatihan')->insert([
                'nama' => $nama[$i],
                'deskripsi' => $deskripsi[$i],
                'jumlah_pertemuan' =>$jumlah_pertemuan[$i],
                
            ]);
        }
    }
}

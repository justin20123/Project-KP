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
        $nama= [
            "Anak Yanta 1",
            "Anak Yanta 2",
            "Anak Yanta 3",
            "Anak Yanti 1",
            "Anak Yanti 2"
        ];
        $umur =[
            14,12,10,13,11
        ];
        $id_orangtua =[
            '1',
            '1',
            '1',
            '2',
            '2'
        ];


        for($i = 0; $i < 5; $i++) {
            DB::table('peserta')->insert([
                'nama' => $nama[$i],
                'umur' => $umur[$i],
                'id_orangtua' => $id_orangtua[$i],

            ]);
        }
    }
}

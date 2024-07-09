<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PesertaSeeder::class);
        $this->call(PelatihanSeeder::class);
        
        $this->call(PeriodeSeeder::class);
        $this->call(LaporanSeeder::class);

    }
}

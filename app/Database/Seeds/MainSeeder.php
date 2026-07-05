<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('PelangganSeeder');
        $this->call('JenisLayananSeeder');
        $this->call('PengaturanSeeder');
    }
}

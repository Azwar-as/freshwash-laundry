<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Budi Santoso',
                'telepon'    => '081234567890',
                'alamat'     => 'Jl. Merdeka No. 10, Jakarta Selatan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Siti Rahayu',
                'telepon'    => '082345678901',
                'alamat'     => 'Jl. Sudirman No. 25, Jakarta Pusat',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Ahmad Hidayat',
                'telepon'    => '083456789012',
                'alamat'     => 'Jl. Gatot Subroto No. 5, Bandung',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Dewi Lestari',
                'telepon'    => '084567890123',
                'alamat'     => 'Jl. Ahmad Yani No. 15, Surabaya',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Rudi Hermawan',
                'telepon'    => '085678901234',
                'alamat'     => 'Jl. Diponegoro No. 30, Semarang',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('pelanggan')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Sadewa Jaya',
                'email'      => 'admin@freshwash.com',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Putri Indah',
                'email'      => 'kasir@freshwash.com',
                'password'   => password_hash('kasir123', PASSWORD_BCRYPT),
                'role'       => 'kasir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->ignore(true)->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisLayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_layanan'  => 'Cuci Kering',
                'deskripsi'     => 'Layanan cuci kering (dry cleaning) untuk pakaian berbahan halus dan formal seperti jas, gaun, dan bahan sutra.',
                'harga'         => 15000.00,
                'satuan'        => 'kg',
                'estimasi_waktu' => 48,
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Cuci Basah',
                'deskripsi'     => 'Layanan cuci basah standar menggunakan mesin cuci untuk pakaian sehari-hari.',
                'harga'         => 8000.00,
                'satuan'        => 'kg',
                'estimasi_waktu' => 24,
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Cuci Setrika',
                'deskripsi'     => 'Layanan cuci lengkap termasuk pengeringan dan setrika rapi. Pakaian siap pakai.',
                'harga'         => 12000.00,
                'satuan'        => 'kg',
                'estimasi_waktu' => 36,
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Setrika Saja',
                'deskripsi'     => 'Layanan setrika saja tanpa cuci. Cocok untuk pakaian yang sudah dicuci sendiri.',
                'harga'         => 6000.00,
                'satuan'        => 'kg',
                'estimasi_waktu' => 12,
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Cuci Sepatu',
                'deskripsi'     => 'Layanan cuci sepatu khusus mencakup pembersihan, penghilangan noda, dan pengeringan.',
                'harga'         => 35000.00,
                'satuan'        => 'pcs',
                'estimasi_waktu' => 72,
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Cuci Karpet',
                'deskripsi'     => 'Layanan cuci karpet dan permadani dengan perawatan khusus.',
                'harga'         => 25000.00,
                'satuan'        => 'm²',
                'estimasi_waktu' => 72,
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Cuci Bed Cover',
                'deskripsi'     => 'Layanan cuci bed cover, sprei, dan selimut tebal.',
                'harga'         => 30000.00,
                'satuan'        => 'pcs',
                'estimasi_waktu' => 48,
                'status'        => 'nonaktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('jenis_layanan')->insertBatch($data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table            = 'detail_transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'transaksi_id',
        'jenis_layanan_id',
        'jumlah',
        'subtotal',
    ];

    protected $useTimestamps = false;

    public function getDetailByTransaksi($transaksiId)
    {
        return $this->select('detail_transaksi.*, jenis_layanan.nama_layanan, jenis_layanan.harga, jenis_layanan.satuan')
                    ->join('jenis_layanan', 'jenis_layanan.id = detail_transaksi.jenis_layanan_id', 'left')
                    ->where('transaksi_id', $transaksiId)
                    ->findAll();
    }
}

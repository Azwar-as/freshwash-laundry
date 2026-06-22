<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'kode_transaksi',
        'pelanggan_id',
        'user_id',
        'tanggal_masuk',
        'tanggal_selesai',
        'total_harga',
        'status',
        'catatan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generateKode()
    {
        $today = date('Ymd');
        $lastTrx = $this->like('kode_transaksi', "TRX-{$today}", 'after')
                        ->orderBy('id', 'DESC')
                        ->first();

        if ($lastTrx) {
            $lastNum = (int) substr($lastTrx['kode_transaksi'], -3);
            $newNum  = $lastNum + 1;
        } else {
            $newNum = 1;
        }

        return "TRX-{$today}-" . str_pad($newNum, 3, '0', STR_PAD_LEFT);
    }

    public function getTransaksiWithRelations($id = null)
    {
        $builder = $this->select('transaksi.*, pelanggan.nama as nama_pelanggan, pelanggan.telepon, users.nama as nama_kasir')
                        ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id', 'left')
                        ->join('users', 'users.id = transaksi.user_id', 'left');

        if ($id) {
            return $builder->find($id);
        }

        return $builder->orderBy('transaksi.created_at', 'DESC')->findAll();
    }
}

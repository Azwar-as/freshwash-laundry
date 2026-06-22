<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class Laporan extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $detailModel    = new DetailTransaksiModel();

        $dari   = $this->request->getGet('dari') ?: date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?: date('Y-m-d');

        // Transaksi dalam periode
        $transaksi = $transaksiModel
            ->select('transaksi.*, pelanggan.nama as nama_pelanggan')
            ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id', 'left')
            ->where('tanggal_masuk >=', $dari)
            ->where('tanggal_masuk <=', $sampai)
            ->orderBy('tanggal_masuk', 'DESC')
            ->findAll();

        // Total pendapatan
        $totalPendapatan = 0;
        foreach ($transaksi as $trx) {
            $totalPendapatan += (float) $trx['total_harga'];
        }

        // Layanan terpopuler
        $layananPopuler = $detailModel
            ->select('jenis_layanan.nama_layanan, SUM(detail_transaksi.jumlah) as total_jumlah, COUNT(detail_transaksi.id) as total_order')
            ->join('jenis_layanan', 'jenis_layanan.id = detail_transaksi.jenis_layanan_id', 'left')
            ->join('transaksi', 'transaksi.id = detail_transaksi.transaksi_id', 'left')
            ->where('transaksi.tanggal_masuk >=', $dari)
            ->where('transaksi.tanggal_masuk <=', $sampai)
            ->groupBy('detail_transaksi.jenis_layanan_id')
            ->orderBy('total_order', 'DESC')
            ->findAll(5);

        $data = [
            'title'           => 'Laporan',
            'transaksi'       => $transaksi,
            'totalPendapatan' => $totalPendapatan,
            'totalTransaksi'  => count($transaksi),
            'layananPopuler'  => $layananPopuler,
            'dari'            => $dari,
            'sampai'          => $sampai,
        ];

        return view('laporan/index', $data);
    }
}

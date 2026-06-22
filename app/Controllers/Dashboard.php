<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\PelangganModel;
use App\Models\JenisLayananModel;

class Dashboard extends BaseController
{
    /**
     * Halaman Dashboard - ringkasan semua data
     */
    public function index()
    {
        $transaksiModel  = new TransaksiModel();
        $pelangganModel  = new PelangganModel();
        $layananModel    = new JenisLayananModel();

        $today     = date('Y-m-d');
        $bulanIni  = date('Y-m');

        // Statistik
        $totalPelanggan   = $pelangganModel->countAllResults();
        $totalLayananAktif = $layananModel->where('status', 'aktif')->countAllResults();
        $transaksiHariIni = $transaksiModel->where('tanggal_masuk', $today)->countAllResults();

        // Pendapatan bulan ini
        $pendapatanBulan = $transaksiModel
            ->selectSum('total_harga')
            ->like('tanggal_masuk', $bulanIni, 'after')
            ->first();
        $pendapatanBulanIni = $pendapatanBulan['total_harga'] ?? 0;

        // 5 Transaksi terakhir
        $transaksiTerakhir = $transaksiModel->getTransaksiWithRelations();
        $transaksiTerakhir = array_slice($transaksiTerakhir, 0, 5);

        // Statistik status transaksi
        $statusAntrian = $transaksiModel->where('status', 'antrian')->countAllResults();
        $statusProses  = $transaksiModel->where('status', 'proses')->countAllResults();
        $statusSelesai = $transaksiModel->where('status', 'selesai')->countAllResults();

        $data = [
            'title'              => 'Dashboard',
            'totalPelanggan'     => $totalPelanggan,
            'totalLayananAktif'  => $totalLayananAktif,
            'transaksiHariIni'   => $transaksiHariIni,
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'transaksiTerakhir'  => $transaksiTerakhir,
            'statusAntrian'      => $statusAntrian,
            'statusProses'       => $statusProses,
            'statusSelesai'      => $statusSelesai,
        ];

        return view('dashboard/index', $data);
    }
}

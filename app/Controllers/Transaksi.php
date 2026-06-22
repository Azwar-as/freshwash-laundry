<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\PelangganModel;
use App\Models\JenisLayananModel;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $detailModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel    = new DetailTransaksiModel();
    }

    public function index()
    {
        $status = $this->request->getGet('status');

        $builder = $this->transaksiModel
            ->select('transaksi.*, pelanggan.nama as nama_pelanggan, users.nama as nama_kasir')
            ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id', 'left')
            ->join('users', 'users.id = transaksi.user_id', 'left');

        if ($status && in_array($status, ['antrian', 'proses', 'selesai', 'diambil'])) {
            $builder->where('transaksi.status', $status);
        }

        $transaksi = $builder->orderBy('transaksi.created_at', 'DESC')->findAll();

        $data = [
            'title'       => 'Data Transaksi',
            'transaksi'   => $transaksi,
            'filterStatus' => $status,
        ];

        return view('transaksi/index', $data);
    }

    public function create()
    {
        $pelangganModel = new PelangganModel();
        $layananModel   = new JenisLayananModel();

        $data = [
            'title'     => 'Buat Transaksi Baru',
            'pelanggan' => $pelangganModel->orderBy('nama', 'ASC')->findAll(),
            'layanan'   => $layananModel->where('status', 'aktif')->orderBy('nama_layanan', 'ASC')->findAll(),
        ];

        return view('transaksi/create', $data);
    }

    public function store()
    {
        $rules = [
            'pelanggan_id'  => 'required|integer',
            'tanggal_masuk' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/transaksi/create')->withInput()->with('error', 'Data tidak valid. Periksa kembali form.');
        }

        $items = $this->request->getPost('items');

        if (empty($items) || !is_array($items)) {
            return redirect()->to('/transaksi/create')->withInput()->with('error', 'Tambahkan minimal 1 item layanan.');
        }

        $layananModel = new JenisLayananModel();
        $totalHarga = 0;
        $processedItems = [];

        // Validasi dan hitung subtotal secara server-side
        foreach ($items as $item) {
            $layananId = $item['jenis_layanan_id'] ?? 0;
            $jumlah    = (float) ($item['jumlah'] ?? 0);

            if ($jumlah <= 0) {
                return redirect()->to('/transaksi/create')->withInput()->with('error', 'Jumlah layanan tidak valid.');
            }

            $layanan = $layananModel->find($layananId);
            if (!$layanan) {
                return redirect()->to('/transaksi/create')->withInput()->with('error', 'Jenis layanan tidak valid.');
            }

            $subtotal = $layanan['harga'] * $jumlah;
            $totalHarga += $subtotal;

            $processedItems[] = [
                'jenis_layanan_id' => $layananId,
                'jumlah'           => $jumlah,
                'subtotal'         => $subtotal,
            ];
        }

        // Simpan transaksi
        $transaksiData = [
            'kode_transaksi'  => $this->transaksiModel->generateKode(),
            'pelanggan_id'    => $this->request->getPost('pelanggan_id'),
            'user_id'         => session()->get('user_id'),
            'tanggal_masuk'   => $this->request->getPost('tanggal_masuk'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai') ?: null,
            'total_harga'     => $totalHarga,
            'status'          => 'antrian',
            'catatan'         => $this->request->getPost('catatan'),
        ];

        $this->transaksiModel->insert($transaksiData);
        $transaksiId = $this->transaksiModel->getInsertID();

        // Simpan detail transaksi
        foreach ($processedItems as $pItem) {
            $this->detailModel->insert([
                'transaksi_id'     => $transaksiId,
                'jenis_layanan_id' => $pItem['jenis_layanan_id'],
                'jumlah'           => $pItem['jumlah'],
                'subtotal'         => $pItem['subtotal'],
            ]);
        }

        session()->setFlashdata('success', 'Transaksi berhasil dibuat dengan kode: ' . $transaksiData['kode_transaksi']);
        return redirect()->to('/transaksi');
    }

    public function show($id = null)
    {
        $transaksi = $this->transaksiModel->getTransaksiWithRelations($id);

        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan.');
        }

        $detail = $this->detailModel->getDetailByTransaksi($id);

        $data = [
            'title'     => 'Detail Transaksi',
            'transaksi' => $transaksi,
            'detail'    => $detail,
        ];

        return view('transaksi/show', $data);
    }

    public function updateStatus($id = null)
    {
        $transaksi = $this->transaksiModel->find($id);

        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan.');
        }

        $newStatus = $this->request->getPost('status');
        $validStatuses = ['antrian', 'proses', 'selesai', 'diambil'];

        if (!in_array($newStatus, $validStatuses)) {
            session()->setFlashdata('error', 'Status tidak valid.');
            return redirect()->to('/transaksi');
        }

        $updateData = ['status' => $newStatus];

        // Set tanggal selesai otomatis saat status jadi "selesai"
        if ($newStatus === 'selesai' && empty($transaksi['tanggal_selesai'])) {
            $updateData['tanggal_selesai'] = date('Y-m-d');
        }

        $this->transaksiModel->update($id, $updateData);

        session()->setFlashdata('success', 'Status transaksi berhasil diperbarui menjadi "' . ucfirst($newStatus) . '".');
        return redirect()->to('/transaksi');
    }

    public function delete($id = null)
    {
        $transaksi = $this->transaksiModel->find($id);

        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan.');
        }

        // Detail akan terhapus otomatis karena CASCADE
        $this->transaksiModel->delete($id);

        session()->setFlashdata('success', 'Transaksi berhasil dihapus!');
        return redirect()->to('/transaksi');
    }
}

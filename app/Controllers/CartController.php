<?php

namespace App\Controllers;

use App\Libraries\Cart;
use App\Models\JenisLayananModel;
use App\Models\PelangganModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class CartController extends BaseController
{
    protected Cart $cart;
    protected JenisLayananModel $jenisLayananModel;

    public function __construct()
    {
        $this->cart              = new Cart();
        $this->jenisLayananModel = new JenisLayananModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Keranjang Belanja',
            'items'   => $this->cart->getContents(),
            'total'   => $this->cart->total(),
            'count'   => $this->cart->count(),
            'pelanggan' => (new PelangganModel())->orderBy('nama', 'ASC')->findAll(),
        ];

        return view('cart/index', $data);
    }

    public function add()
    {
        $id  = (int) $this->request->getPost('id');
        $qty = (int) $this->request->getPost('qty') ?: 1;

        $layanan = $this->jenisLayananModel->find($id);

        if (! $layanan || $layanan['status'] !== 'aktif') {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Layanan tidak tersedia.',
            ])->setStatusCode(422);
        }

        $inserted = $this->cart->insert([
            'id'     => $layanan['id'],
            'nama'   => $layanan['nama_layanan'],
            'harga'  => $layanan['harga'],
            'satuan' => $layanan['satuan'],
            'qty'    => $qty,
        ]);

        if (! $inserted) {
            return $this->response->setJSON([
                'status'    => 'error',
                'message'   => 'Gagal menambahkan item ke keranjang.',
                'csrf_hash' => csrf_hash(),
            ])->setStatusCode(422);
        }

        return $this->response->setJSON([
            'status'       => 'success',
            'message'      => '"' . $layanan['nama_layanan'] . '" berhasil ditambahkan ke keranjang.',
            'cart_count'   => $this->cart->totalQty(),
            'cart_total'   => $this->cart->total(),
            'csrf_hash'    => csrf_hash(),
        ]);
    }

    public function update()
    {
        $id  = (int) $this->request->getPost('id');
        $qty = (int) $this->request->getPost('qty');

        $updated = $this->cart->update($id, $qty);

        if (! $updated && $qty > 0) {
            return $this->response->setJSON([
                'status'    => 'error',
                'message'   => 'Item tidak ditemukan di keranjang.',
                'csrf_hash' => csrf_hash(),
            ])->setStatusCode(422);
        }

        return $this->response->setJSON([
            'status'        => 'success',
            'message'       => 'Quantity berhasil diperbarui.',
            'cart_count'    => $this->cart->totalQty(),
            'cart_total'    => $this->cart->total(),
            'item_subtotal' => isset($this->cart->getContents()[$id])
                              ? $this->cart->getContents()[$id]['subtotal']
                              : 0,
            'csrf_hash'     => csrf_hash(),
        ]);
    }

    public function remove()
    {
        $id = (int) $this->request->getPost('id');

        $this->cart->remove($id);

        return $this->response->setJSON([
            'status'     => 'success',
            'message'    => 'Item berhasil dihapus dari keranjang.',
            'cart_count' => $this->cart->totalQty(),
            'cart_total' => $this->cart->total(),
            'csrf_hash'  => csrf_hash(),
        ]);
    }

    public function destroy()
    {
        $this->cart->destroy();

        return $this->response->setJSON([
            'status'     => 'success',
            'message'    => 'Keranjang belanja berhasil dikosongkan.',
            'cart_count' => 0,
            'cart_total' => 0,
            'csrf_hash'  => csrf_hash(),
        ]);
    }

    public function total()
    {
        return $this->response->setJSON([
            'status'     => 'success',
            'cart_count' => $this->cart->totalQty(),
            'cart_total' => $this->cart->total(),
            'csrf_hash'  => csrf_hash(),
        ]);
    }

    public function checkout()
    {
        $items       = $this->cart->getContents();
        $pelangganId = (int) $this->request->getPost('pelanggan_id');
        $catatan     = $this->request->getPost('catatan');

        if (empty($items)) {
            session()->setFlashdata('error', 'Keranjang belanja masih kosong.');
            return redirect()->to('/cart');
        }

        if (! $pelangganId) {
            session()->setFlashdata('error', 'Pilih pelanggan terlebih dahulu.');
            return redirect()->to('/cart');
        }

        $kodeTransaksi = 'TRX-' . strtoupper(substr(uniqid(), -8));

        $transaksiModel = new TransaksiModel();
        $detailModel    = new DetailTransaksiModel();

        $transaksiId = $transaksiModel->insert([
            'kode_transaksi'  => $kodeTransaksi,
            'pelanggan_id'    => $pelangganId,
            'user_id'         => session()->get('user_id'),
            'tanggal_masuk'   => date('Y-m-d'),
            'tanggal_selesai' => null,
            'total_harga'     => $this->cart->total(),
            'status'          => 'antrian',
            'catatan'         => $catatan,
        ]);

        foreach ($items as $item) {
            $detailModel->insert([
                'transaksi_id'     => $transaksiId,
                'jenis_layanan_id' => $item['id'],
                'jumlah'           => $item['qty'],
                'subtotal'         => $item['subtotal'],
            ]);
        }

        $grandTotal = $this->cart->total();

        $this->cart->destroy();

        session()->setFlashdata('success', "Pesanan <strong>{$kodeTransaksi}</strong> berhasil dibuat! Total: Rp " . number_format($grandTotal, 0, ',', '.'));
        return redirect()->to('/transaksi');
    }
}

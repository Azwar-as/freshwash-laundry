<?php

namespace App\Controllers;

use App\Models\JenisLayananModel;

class JenisLayanan extends BaseController
{
    protected $jenisLayananModel;

    public function __construct()
    {
        $this->jenisLayananModel = new JenisLayananModel();
        helper('text');
    }

   /* Menampilkan daftar semua jenis layanan */
    public function index()
    {
        $data = [
            'title'    => 'Daftar Jenis Layanan',
            'layanan'  => $this->jenisLayananModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('jenis_layanan/index', $data);
    }

    /* Menampilkan form tambah jenis layanan baru */
    public function create()
    {
        $data = [
            'title'      => 'Tambah Jenis Layanan',
            'validation' => \Config\Services::validation(),
        ];

        return view('jenis_layanan/create', $data);
    }

    /*
     Menyimpan data jenis layanan baru
     */
    public function store()
    {
        // Validasi input
        $rules = [
            'nama_layanan'  => 'required|max_length[100]',
            'harga'         => 'required|numeric|greater_than[0]',
            'satuan'        => 'required|max_length[20]',
            'estimasi_waktu' => 'required|integer|greater_than[0]',
            'status'        => 'required|in_list[aktif,nonaktif]',
        ];

        $messages = [
            'nama_layanan' => [
                'required'   => 'Nama layanan harus diisi.',
                'max_length' => 'Nama layanan maksimal 100 karakter.',
            ],
            'harga' => [
                'required'     => 'Harga harus diisi.',
                'numeric'      => 'Harga harus berupa angka.',
                'greater_than' => 'Harga harus lebih dari 0.',
            ],
            'satuan' => [
                'required'   => 'Satuan harus diisi.',
                'max_length' => 'Satuan maksimal 20 karakter.',
            ],
            'estimasi_waktu' => [
                'required'     => 'Estimasi waktu harus diisi.',
                'integer'      => 'Estimasi waktu harus berupa angka bulat.',
                'greater_than' => 'Estimasi waktu harus lebih dari 0.',
            ],
            'status' => [
                'required' => 'Status harus dipilih.',
                'in_list'  => 'Status harus aktif atau nonaktif.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/jenis-layanan/create')->withInput()->with('validation', \Config\Services::validation());
        }

        $this->jenisLayananModel->save([
            'nama_layanan'   => $this->request->getPost('nama_layanan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'harga'          => $this->request->getPost('harga'),
            'satuan'         => $this->request->getPost('satuan'),
            'estimasi_waktu' => $this->request->getPost('estimasi_waktu'),
            'status'         => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('success', 'Data jenis layanan berhasil ditambahkan!');
        return redirect()->to('/jenis-layanan');
    }

    /*
     Menampilkan form edit jenis layanan
     */
    public function edit($id = null)
    {
        $layanan = $this->jenisLayananModel->find($id);

        if (!$layanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data layanan tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Jenis Layanan',
            'layanan'    => $layanan,
            'validation' => \Config\Services::validation(),
        ];

        return view('jenis_layanan/edit', $data);
    }

    /*
      Mengupdate data jenis layanan
     */
    public function update($id = null)
    {
        $layanan = $this->jenisLayananModel->find($id);

        if (!$layanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data layanan tidak ditemukan.');
        }

        // Validasi input
        $rules = [
            'nama_layanan'  => 'required|max_length[100]',
            'harga'         => 'required|numeric|greater_than[0]',
            'satuan'        => 'required|max_length[20]',
            'estimasi_waktu' => 'required|integer|greater_than[0]',
            'status'        => 'required|in_list[aktif,nonaktif]',
        ];

        $messages = [
            'nama_layanan' => [
                'required'   => 'Nama layanan harus diisi.',
                'max_length' => 'Nama layanan maksimal 100 karakter.',
            ],
            'harga' => [
                'required'     => 'Harga harus diisi.',
                'numeric'      => 'Harga harus berupa angka.',
                'greater_than' => 'Harga harus lebih dari 0.',
            ],
            'satuan' => [
                'required'   => 'Satuan harus diisi.',
                'max_length' => 'Satuan maksimal 20 karakter.',
            ],
            'estimasi_waktu' => [
                'required'     => 'Estimasi waktu harus diisi.',
                'integer'      => 'Estimasi waktu harus berupa angka bulat.',
                'greater_than' => 'Estimasi waktu harus lebih dari 0.',
            ],
            'status' => [
                'required' => 'Status harus dipilih.',
                'in_list'  => 'Status harus aktif atau nonaktif.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/jenis-layanan/edit/' . $id)->withInput()->with('validation', \Config\Services::validation());
        }

        $this->jenisLayananModel->update($id, [
            'nama_layanan'   => $this->request->getPost('nama_layanan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'harga'          => $this->request->getPost('harga'),
            'satuan'         => $this->request->getPost('satuan'),
            'estimasi_waktu' => $this->request->getPost('estimasi_waktu'),
            'status'         => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('success', 'Data jenis layanan berhasil diperbarui!');
        return redirect()->to('/jenis-layanan');
    }

    /*
      Menghapus data jenis layanan
     */
    public function delete($id = null)
    {
        $layanan = $this->jenisLayananModel->find($id);

        if (!$layanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data layanan tidak ditemukan.');
        }

        $this->jenisLayananModel->delete($id);

        session()->setFlashdata('success', 'Data jenis layanan berhasil dihapus!');
        return redirect()->to('/jenis-layanan');
    }
}

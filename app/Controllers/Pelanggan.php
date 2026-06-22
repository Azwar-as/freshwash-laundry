<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Pelanggan',
            'pelanggan' => $this->pelangganModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('pelanggan/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Pelanggan',
            'validation' => \Config\Services::validation(),
        ];

        return view('pelanggan/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|max_length[100]',
        ];

        $messages = [
            'nama' => [
                'required'   => 'Nama pelanggan harus diisi.',
                'max_length' => 'Nama pelanggan maksimal 100 karakter.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/pelanggan/create')->withInput()->with('validation', \Config\Services::validation());
        }

        $this->pelangganModel->save([
            'nama'    => $this->request->getPost('nama'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat'  => $this->request->getPost('alamat'),
        ]);

        session()->setFlashdata('success', 'Data pelanggan berhasil ditambahkan!');
        return redirect()->to('/pelanggan');
    }

    public function edit($id = null)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pelanggan tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Pelanggan',
            'pelanggan'  => $pelanggan,
            'validation' => \Config\Services::validation(),
        ];

        return view('pelanggan/edit', $data);
    }

    public function update($id = null)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pelanggan tidak ditemukan.');
        }

        $rules = [
            'nama' => 'required|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/pelanggan/edit/' . $id)->withInput()->with('validation', \Config\Services::validation());
        }

        $this->pelangganModel->update($id, [
            'nama'    => $this->request->getPost('nama'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat'  => $this->request->getPost('alamat'),
        ]);

        session()->setFlashdata('success', 'Data pelanggan berhasil diperbarui!');
        return redirect()->to('/pelanggan');
    }

    public function delete($id = null)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data pelanggan tidak ditemukan.');
        }

        $this->pelangganModel->delete($id);

        session()->setFlashdata('success', 'Data pelanggan berhasil dihapus!');
        return redirect()->to('/pelanggan');
    }
}

<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\UserModel;

class Pengaturan extends BaseController
{
    protected $pengaturanModel;

    public function __construct()
    {
        $this->pengaturanModel = new PengaturanModel();
    }

    /**
     * Halaman pengaturan toko
     */
    public function index()
    {
        $data = [
            'title'    => 'Pengaturan Toko',
            'settings' => $this->pengaturanModel->getAllSettings(),
        ];

        return view('pengaturan/index', $data);
    }

    // simpan pengaturan toko
    public function update()
    {
        $keys = ['nama_toko', 'alamat_toko', 'telepon_toko', 'email_toko', 'jam_buka', 'deskripsi'];

        foreach ($keys as $key) {
            $value = $this->request->getPost($key);
            if ($value !== null) {
                $this->pengaturanModel->setValue($key, $value);
            }
        }

        session()->setFlashdata('success', 'Pengaturan toko berhasil diperbarui!');
        return redirect()->to('/pengaturan');
    }

    // halaman profil user
    public function profile()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        $data = [
            'title' => 'Profil Saya',
            'user'  => $user,
        ];

        return view('pengaturan/profile', $data);
    }

    /**
     * Update profil user
     */
    public function updateProfile()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $rules = [
            'nama'  => 'required|max_length[100]',
            'email' => "required|valid_email|is_unique[users.email,id,{$userId}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/pengaturan/profile')->withInput()->with('validation', \Config\Services::validation());
        }

        $updateData = [
            'nama'  => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ];

        // Update password jika diisi
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            if (strlen($password) < 6) {
                return redirect()->to('/pengaturan/profile')->withInput()->with('error', 'Password minimal 6 karakter.');
            }
            $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $userModel->update($userId, $updateData);

        // Update session data
        session()->set([
            'user_nama'  => $updateData['nama'],
            'user_email' => $updateData['email'],
        ]);

        session()->setFlashdata('success', 'Profil berhasil diperbarui!');
        return redirect()->to('/pengaturan/profile');
    }
}

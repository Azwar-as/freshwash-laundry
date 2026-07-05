<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function authenticate()
    {        
        $rules = [
            'email'    => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'max_length'  => 'Email terlalu panjang (maks. 100 karakter).',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 6 karakter.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/auth/login')
                ->withInput()
                ->with('validation', $this->validator);
        }

        $email     = $this->request->getPost('email');
        $password  = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->where('email', $email)->first();

        if (! $user) {
            return redirect()
                ->to('/auth/login')
                ->withInput()
                ->with('error', 'Email tidak ditemukan.');
        }

        if (! password_verify($password, $user['password'])) {
            return redirect()
                ->to('/auth/login')
                ->withInput()
                ->with('error', 'Password salah.');
        }


        session()->set([
            'user_id'    => $user['id'],
            'user_nama'  => $user['nama'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
            'isLoggedIn' => true,
        ]);

        return redirect()
            ->to('/dashboard')
            ->with('success', 'Selamat datang, ' . $user['nama'] . '!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda berhasil logout.');
    }
}

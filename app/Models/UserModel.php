<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama'  => 'required|max_length[100]',
        'email' => 'required|valid_email|max_length[100]',
        'role'  => 'required|in_list[admin,kasir]',
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama harus diisi.',
        ],
        'email' => [
            'required'    => 'Email harus diisi.',
            'valid_email' => 'Format email tidak valid.',
        ],
    ];
}

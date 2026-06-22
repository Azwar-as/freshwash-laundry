<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama',
        'telepon',
        'alamat',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama pelanggan harus diisi.',
            'max_length' => 'Nama pelanggan maksimal 100 karakter.',
        ],
    ];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLayananModel extends Model
{
    protected $table            = 'jenis_layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'satuan',
        'estimasi_waktu',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama_layanan'  => 'required|max_length[100]',
        'harga'         => 'required|numeric|greater_than[0]',
        'satuan'        => 'required|max_length[20]',
        'estimasi_waktu' => 'required|integer|greater_than[0]',
        'status'        => 'required|in_list[aktif,nonaktif]',
    ];

    protected $validationMessages = [
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

    protected $skipValidation = false;
}

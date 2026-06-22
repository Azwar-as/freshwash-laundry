<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table            = 'pengaturan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'key',
        'value',
    ];

    protected $useTimestamps = false;

    /**
     * Get setting value by key
     */
    public function getValue($key, $default = null)
    {
        $row = $this->where('key', $key)->first();
        return $row ? $row['value'] : $default;
    }

    /**
     * Set setting value by key
     */
    public function setValue($key, $value)
    {
        $existing = $this->where('key', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], ['value' => $value]);
        }

        return $this->insert(['key' => $key, 'value' => $value]);
    }

    /**
     * Get all settings as associative array
     */
    public function getAllSettings()
    {
        $rows = $this->findAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }
}

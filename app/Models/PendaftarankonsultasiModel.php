<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftarankonsultasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pendaftarankonsultasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    static function view(){
        return (new PendaftarankonsultasiModel())
                ->join('jadwalpraktek', 'jadwalpraktek.id=jadwalpraktek_id')
                ->join('pasien', 'pasien.id=pasien_id')
                ->join('petugas', 'petugas.id=petugas_id')
                ->select('pendaftarankonsultasi.*, jadwalpraktek.hari, 
                          pasien.nama, petugas.nama_lengkap,');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PoliDokterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'polidokter';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
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
        return (new PoliDokterModel())
        ->join('poli', 'poli.id=poli_id')
        ->join('dokter', 'dokter.id=dokter_id')
        ->select('polidokter.*,poli.deskripsi , dokter.nama_depan,');
    }
}

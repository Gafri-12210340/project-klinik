<?php

namespace App\Database\Seeds;

use App\Models\JasaBarangModel;
use CodeIgniter\Database\Seeder;

class JasaBarangSeeder extends Seeder
{
    public function run()
    {
        $id = (new JasaBarangModel())->insert([
            'nama'          => 'Paracetamol',
            'jenis'         => 'B',
            'harga'         => '20.000',
            'keterangan'    => 'Obat Paracetamol',
          ]);
  
          echo "hasil id = $id";
    }
}

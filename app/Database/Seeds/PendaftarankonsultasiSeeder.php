<?php

namespace App\Database\Seeds;

use App\Models\PendaftarankonsultasiModel;
use CodeIgniter\Database\Seeder;

class PendaftarankonsultasiSeeder extends Seeder
{
    public function run()
    {
     
       $id = (new PendaftarankonsultasiModel())->insert([
            'tgl' => '2001-03-15',
            'jadwalpraktek_id' => '1',
            'pasien_id' => '1',
            'petugas_id' => '1',
       ]);
       echo "hasil id = $id";
    }
}

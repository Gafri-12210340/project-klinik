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
            'no_antrian' => '2',
            'berat_badan' => '35',
            'tinggi_badan' => '165',
            'temp_badan' => '35',
            'lingkar_kepala' => '50',
            'keluhan' => 'sakit tenggorokan',
            'petugas_id' => '1',
       ]);
       echo "hasil id = $id";
    }
}

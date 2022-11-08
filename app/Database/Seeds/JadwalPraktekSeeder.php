<?php

namespace App\Database\Seeds;

use App\Models\JadwalPraktekModel;
use CodeIgniter\Database\Seeder;

class JadwalPraktekSeeder extends Seeder
{
    public function run()
    {
    $id = (new JadwalPraktekModel())->insert([
      'polidokter_id' => '1',
      'hari' => '1',
      'jam_mulai' => '11:00',
      'jam_selesai' => '14:00',
    ]);
    echo "hasil = $id";
    }
}

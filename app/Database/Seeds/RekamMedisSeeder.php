<?php

namespace App\Database\Seeds;

use App\Models\RekamMedis;
use App\Models\RekamMedisModel;
use CodeIgniter\Database\Seeder;

class RekamMedisSeeder extends Seeder
{
    public function run()
    {
        $id = (new RekamMedisModel())->insert([
          'pendaftarankonsultasi_id'   => '1',
          'pasien_id'                  => '1',
          'diagnosa'                   => 'Kanker stadium 4',
          'tindakan'                   => 'Operasi',
          'terapi'                     => 'Terapi Kanker',
          'resep_obat'                 => 'Paracetamol',
          'alergi'                     => 'Alergi Oksigen',
          'dokter_id'                  => '1',
        ]);

        echo "hasil id = $id";
    }
}

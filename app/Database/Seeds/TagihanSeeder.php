<?php

namespace App\Database\Seeds;

use App\Models\TagihanModel;
use CodeIgniter\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run()
    {
        
        $id = (new TagihanModel())->insert([
            'pendaftarankonsultasi_id'  => '1',
            'tgl'                        => '2022-11-12 08:02:12',
            'subtotal'                   => '20.000',
            'ppn'                        => '2.000',
            'dibayar'                    => '50.000',
            'petugas_id'                 => '1',
          ]);
  
          echo "hasil id = $id";
    }
}

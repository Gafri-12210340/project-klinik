<?php

namespace App\Database\Seeds;

use App\Models\PasienModel;
use CodeIgniter\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run()
    {
        $id = (new PasienModel())->insert([
            'nama'          => 'Kolas',
            'jenis_kelamin'         => 'L',
            'alamat'         => 'Jl.Amsterdam',
            'kota'    => 'Pontianak',
          ]);
  
          echo "hasil id = $id";
    }
}

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
            'nama_belakang'          => 'situmorang',
            'no_rekammedik' => '10',
            'nik'           => '12210340',
            'jenis_kelamin'         => 'L',
            'tgl_lahir'     => '2002-10-10',
            'tempat_lahir'          => 'serasan',
            'alamat'         => 'Jl.Amsterdam',
            'kota'    => 'Pontianak',
            'no_telp' => '0822',
            'email'          => 'kolas@gmail.com',
            'golongan_darah' => 'B',
            'sandi'          => password_hash('12345678', PASSWORD_BCRYPT),
            'token_reset'          => '',
          ]);
  
          echo "hasil id = $id";
    }
}

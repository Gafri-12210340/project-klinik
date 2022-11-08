<?php

namespace App\Database\Seeds;

use App\Models\DokterModel;
use CodeIgniter\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run()
    {
        $r = (int)(new DokterModel())->insert([
            'nama_depan' => 'nana',
            'nama_belakang'  => 'mobelejen',
            'gelar_depan'    => 'M.kom',
            'gelar_belakang' => 'M.sh',
            'jenis_kelamin'  => 'P',
            'tempat_lahir'   => 'serasan',
            'tgl_lahir'      => '2022-09-12',
            'alamat'         => 'pontianak',
            'kota'           => 'pontianak',
            'no_telp_rmh'     => '0822',
            'no_hp'          => '0822',
            'no_wa'          => '0822',
            'email'          => 'nana@gmail.com',
            'sandi'          => password_hash('12345678', PASSWORD_BCRYPT),
            'token_reset'    => '123',
            'no_izin_praktek' => '32',
            'tgl_sk_izin'      => '50',
        ]);

        echo "hasil insert $r";
    }
}

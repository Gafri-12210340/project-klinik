<?php

namespace App\Database\Seeds;

use App\Models\PoliDokterModel;
use CodeIgniter\Database\Seeder;

class PoliDokterSeeder extends Seeder
{
    public function run()
    {
        $r = (int)(new PoliDokterModel())->insert([
            'poli_id' => 1,
            'dokter_id' => 1,
        ]);

        echo "hasil insert $r";
    }
}

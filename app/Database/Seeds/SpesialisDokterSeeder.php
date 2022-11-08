<?php

namespace App\Database\Seeds;

use App\Models\SpesialisDokterModel;
use CodeIgniter\Database\Seeder;

class SpesialisDokterSeeder extends Seeder
{
    public function run()
    {
        $r = (int)(new SpesialisDokterModel())->insert([
            'dokter_id' => 1,
            'spesialis_id' => 1,
        ]);

        echo "hasil insert $r";
    }
}

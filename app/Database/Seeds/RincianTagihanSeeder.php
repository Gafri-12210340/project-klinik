<?php

namespace App\Database\Seeds;

use App\Models\RincianTagihanModel;
use CodeIgniter\Database\Seeder;

class RincianTagihanSeeder extends Seeder
{
    public function run()
    {
        $id = (new RincianTagihanModel())->insert([
            'tagihan_id'         => '1',
            'jasabarang_id'      => '1',
            'qty'                => '5',
            'harga'              => '10.000',
        ]);
    }
}

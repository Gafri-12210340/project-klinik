<?php

namespace App\Database\Seeds;

use App\Models\SpesialisModel;
use CodeIgniter\Database\Seeder;

class SpesialisSeeder extends Seeder
{
    public function run()
    {
        $id = (new SpesialisModel())->insert([
            'nama' => 'Administrator',
            'gelar' => 'M.kom',
        ]);
        echo "hasil insert = $id";
    }
}

<?php

namespace App\Database\Seeds;

use App\Models\PoliModel;
use CodeIgniter\Database\Seeder;

class PoliSeeder extends Seeder
{
    public function run()
    {
        $id = (new PoliModel())->insert([
            'nama' => 'Administrator',
            'deskripsi' => 'project wp2'
        ]);

        echo "hasil id = $id";
    }
}

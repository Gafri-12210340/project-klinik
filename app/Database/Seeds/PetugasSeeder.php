<?php

namespace App\Database\Seeds;

use App\Models\PetugasModel;
use CodeIgniter\Database\Seeder;

class PetugasSeeder extends Seeder
{
    public function run()
    {
     
       $id = (new PetugasModel())->insert([
           'email' => 'gafrii@gmail.com',
            'nama_lengkap' => 'gafri gangtengs',
            'sandi' => password_hash('gafrip',PASSWORD_BCRYPT),
       ]);
       echo "hasil id = $id";
    }
}

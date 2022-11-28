<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
    public function run()
    {
        $this->call('SpesialisSeeder');
        $this->call('DokterSeeder');
        $this->call('SpesialisDokterSeeder');
        $this->call('PoliSeeder');
        $this->call('PoliDokterSeeder');
        $this->call('JadwalPraktekSeeder');
        $this->call('PetugasSeeder');
        $this->call('PasienSeeder');
        $this->call('Pendaftarankonsultasiseeder');
        $this->call('RekamMedisSeeder');
        $this->call('TagihanSeeder');
        $this->call('JasaBarangSeeder');
        $this->call('RincianTagihanSeeder');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class Pasien extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id'            => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
        'no_rekammedik' => ['type' =>'varchar', 'constraint'=>80, 'null'    =>true],
        'nama'          => ['type' =>'varchar', 'constraint'=>50, 'null'    =>true], 
        'nama_belakang' => ['type' =>'varchar', 'constraint'=>80, 'null'    =>true],
        'nik'           => ['type' =>'varchar', 'constraint'=>16, 'null'    =>true],
        'jenis_kelamin' => ['type' =>'enum("L","P")',              'null'   =>true],
        'tgl_lahir'     => ['type' =>'date', 'null'         =>true],
        'tempat_lahir'  => ['type' =>'varchar','constraint' =>50,  'null'   =>true],
        'alamat'        => ['type' =>'varchar','constraint' =>225, 'null'   =>true],
        'kota'          => ['type' =>'varchar','constraint' =>100, 'null'   =>true],
        'no_telp'       => ['type' =>'varchar','constraint' =>17,  'null'   =>true],
        'email'         => ['type' =>'varchar','constraint'=>128,'null'     =>true],
        'golongan_darah'=> ['type' =>'enum("B","A")',              'null'   =>true],
        'foto'          => ['type' =>'varbinary','constraint' =>255, 'null'   =>true],
        'sandi'         => ['type' =>'varchar', 'constraint'=>60,  'null'   =>true],
        'token_reset'   => ['type' =>'varchar', 'constraint'=>10,  'null'   =>true],
        'created_at'    =>['type'=>'datetime', 'null'=>true],
        'updated_at'    =>['type'=>'datetime', 'null'=>true],
        'deleted_at'    =>['type'=>'datetime', 'null'=>true],
    ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createtable('pasien');
    }
    public function down()
    {
        $this->forge->dropTable('pasien');
    }
}

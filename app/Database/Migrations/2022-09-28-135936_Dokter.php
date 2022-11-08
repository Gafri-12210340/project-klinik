<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Config\Migrations;

class Dokter extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'                => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama_depan'        => [ 'type'=>'varchar', 'constraint'=>50, 'null'=>false ],
            'nama_belakang'     => [ 'type'=>'varchar', 'constraint'=>80, 'null'=>true ],
            'gelar_depan'       => [ 'type'=>'varchar', 'constraint'=>25, 'null'=>true ],
            'gelar_belakang'    => [ 'type'=>'varbinary', 'constraint'=>25, 'null'=>true ],
            'jenis_kelamin'     => [ 'type'=>'enum("L","P")', 'null'=>true ],
            'tempat_lahir'      => [ 'type'=>'varchar', 'constraint'=>80, 'null'=>true],
            'tgl_lahir'         => [ 'type'=>'date', 'null'=>true ],
            'alamat'            => [ 'type'=>'varchar', 'constraint'=>80, 'null'=>true ],
            'kota'              => [ 'type'=>'varchar', 'constraint'=>30, 'null'=>true ],
            'no_telp_rmh'       => [ 'type'=>'varchar', 'constraint'=>15, 'null'=>true ],
            'no_hp'             => [ 'type'=>'varchar', 'constraint'=>15, 'null'=>true ],
            'no_wa'             => [ 'type'=>'varchar', 'constraint'=>15, 'null'=>true ],
            'email'             => [ 'type'=>'varchar', 'constraint'=>128, 'null'=>true ],
            'sandi'             => [ 'type'=>'varchar', 'constraint'=>60, 'null'=>true ],
            'token_reset'       => [ 'type'=>'varchar', 'constraint'=>16, 'null'=>true ],
            'no_izin_praktek'   => [ 'type'=>'varchar', 'constraint'=>80, 'null'=>true ],
            'tgl_sk_izin'       => [ 'type'=>'date', 'null'=>true ],
            'created_at'        => [ 'type'=>'date', 'null'=>true ],
            'updated_at'        => [ 'type'=>'date', 'null'=>true ],
            'deleted_at'        => [ 'type'=>'date', 'null'=>true ],


        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('dokter');
    }

    public function down()
    {
        $this->forge->dropTable('dokter');
    }
}

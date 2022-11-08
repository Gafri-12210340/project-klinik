<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tagihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                             => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'pendaftarankonsultasi_id'       => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
            'tgl'                            => ['type'=> 'datetime','null'=>false],
            'subtotal'                       => ['type'=> 'double','null'  =>false],
            'ppn'                            => ['type'=> 'double','null'  =>false],
            'dibayar'                        => ['type'=> 'double','null'  =>true],
            'petugas_id'                     => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
            'created_at'                     => ['type'=> 'datetime','null'=>true],
            'updated_at'                     => ['type'=> 'datetime','null'=>true],

        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pendaftarankonsultasi_id', 'pendaftarankonsultasi', 'id', 'cascade');
        $this->forge->addForeignKey('petugas_id', 'petugas', 'id', 'cascade');
        $this->forge->createTable('tagihan');

    }

    public function down()
    {
        $this->forge->dropTable('tagihan');
    }
}

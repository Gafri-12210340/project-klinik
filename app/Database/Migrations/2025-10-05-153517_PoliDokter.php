<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PoliDokter extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'        => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'poli_id'   => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
            'dokter_id' => ['type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('poli_id' , 'poli' , 'id' , 'cascade');
        $this->forge->addForeignKey('dokter_id' , 'dokter' , 'id' , 'cascade');
        $this->forge->createTable('polidokter');
    }

    public function down()
    {
        $this->forge->dropTable('polidokter');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SpesialisDokter extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'            => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'dokter_id'     => ['type'=>'int', 'constraint'=>11, 'unsigned'=>true,],
            'spesialis_id'  => ['type'=>'int', 'constraint'=>11, 'null'=>false, 'unsigned'=>true,],
        ]);
        $this->forge->addPrimarykey('id');
        $this->forge->addForeignKey('dokter_id' , 'dokter' , 'id' , 'cascade');
        $this->forge->addForeignKey('spesialis_id' , 'spesialis' , 'id' , 'cascade');
        $this->forge->createTable('spesialisdokter');
    }

    public function down()
    {
        $this->forge->dropTable('spesialisdokter');
    }
}

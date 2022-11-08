<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JasaBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama'               => ['type'=> 'varchar', 'constraint'=>255, 'null'=>false],
            'jenis'              => ['type'=>'enum("J","B")','null'=>true],
            'harga'              => ['type'=> 'double','unsigned'=>true, 'null'=>false],
            'keterangan'         => ['type'=>'text','null'=>true],
            'created_at'         => ['type'=> 'datetime','null'=>true],
            'updated_at'         => ['type'=> 'datetime','null'=>true],
            'deleted_at'         => ['type'=> 'datetime','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('jasabarang');
        

    }

    public function down()
    {
        $this->forge->dropTable('jasabarang');
    }
}

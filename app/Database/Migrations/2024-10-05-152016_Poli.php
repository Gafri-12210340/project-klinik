<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Poli extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'        => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama'      => ['type'=>'varchar', 'constraint'=>30, 'null'=>false ],
            'deskripsi' => ['type'=>'varchar', 'constraint'=>512, 'null'=>true ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('poli');
    }

    public function down()
    {
        $this->forge->dropTable('poli');
    }
}

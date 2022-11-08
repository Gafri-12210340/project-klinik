<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spesialis extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'    => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama'  => [ 'type'=>'varchar', 'constraint'=>90, 'null'=>false ],
            'gelar' => [ 'type'=>'varchar', 'constraint'=>15, 'null'=>false ],
        ]);
        $this->forge->addprimarykey('id');
        $this->forge->createTable('spesialis');
    }

    public function down()
    {
        $this->forge->dropTable('spesialis');
    }
}

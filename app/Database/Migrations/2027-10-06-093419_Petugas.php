<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'email'         =>['type'=>'varchar','constraint'=>100, 'null'=>false],
            'nama_lengkap'  =>['type'=>'varchar','constraint'=>100, 'null'=>false],
            'level'         =>['type'=>'enum("K","M")', 'null'=>true],
            'sandi'         =>['type'=>'varchar','constraint'=>60, 'null'=>true],
            'foto'          => ['type'=>'varbinary', 'constraint'=>126,'null'=>true],
            'reset_token'   =>['type'=>'varchar','constraint'=>10,'null'=>true],
            'created_at'    =>['type'=>'datetime', 'null'=>true],
            'updated_at'    =>['type'=>'datetime', 'null'=>true],
            'deleted_at'    =>['type'=>'datetime', 'null'=>true],
        ]);
    $this->forge->addprimarykey('id');
    $this->forge->createTable('petugas');
    }
    public function down()
    {
        $this->forge->droptable('petugas');
    }
}

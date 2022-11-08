<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RincianTagihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'tagihan_id'            => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
            'jasabarang_id'         => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
            'qty'                   => ['type'=> 'double','null'  =>false],
            'harga'                 => ['type'=> 'double','null'  =>false],
            'created_at'            => ['type'=> 'datetime','null'=>true],
            'updated_at'            => ['type'=> 'datetime','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('tagihan_id', 'tagihan', 'id', 'cascade');
        $this->forge->addForeignKey('jasabarang_id', 'jasabarang', 'id' , 'cascade');
        $this->forge->createTable('rinciantagihan');
    }

    public function down()
    {
        $this->forge->dropTable('rinciantagihan');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalPraktek extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'polidokter_id'       => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
            'hari'                => [ 'type' =>'int', 'constraint'=>11,'null'=>false],
            'jam_mulai'           => [ 'type' =>'time','null'=>false ],
            'jam_selesai'         => [ 'type' =>'time','null'=>true ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('polidokter_id' , 'polidokter' , 'id' , 'cascade');
        $this->forge->createTable('jadwalpraktek');
        }

    public function down()
    {
        $this->forge->dropTable('jadwalpraktek');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PendaftaranKonsultasi extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id'                => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
        'tgl'               => ['type'=>'date','null'=>true],
        'jadwalpraktek_id'  => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
        'pasien_id'         => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
        'no_antrian'     =>['type'=>'varchar','constraint'=>3, 'null'=>true],
        'berat_badan'       =>['type'=>'double', 'null'=>true],
        'tinggi_badan'      =>['type'=>'double','null'=>true],
        'temp_badan'      =>['type'=>'double','null'=>true],
        'lingkar_kepala'  =>['type'=>'double', 'null'=>true],
        'keluhan'           =>['type' =>'varchar','constraint'=>512, 'null'=>true],
        'petugas_id'        => [ 'type'=>'int', 'constraint'=>10, 'null'=>true, 'unsigned'=>true, ],
        'created_at'        =>['type'=>'datetime', 'null'=>true],
        'updated_at'        =>['type'=>'datetime', 'null'=>true],
        'deleted_at'        =>['type'=>'datetime', 'null'=>true],
    ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('jadwalpraktek_id' , 'jadwalpraktek' , 'id' , 'cascade');
        $this->forge->addForeignKey('petugas_id' , 'petugas' , 'id' , 'cascade');
        $this->forge->addForeignKey('pasien_id' , 'pasien' , 'id' , 'cascade');
    


        $this->forge->createTable('pendaftarankonsultasi');
}
    public function down()
    {
     $this->forge->dropTable('pendaftarankonsultasi');
    }
}

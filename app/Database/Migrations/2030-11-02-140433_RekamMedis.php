<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RekamMedis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                                  => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'pendaftarankonsultasi_id'            => [ 'type'=>'int', 'constraint'=>10,  'unsigned'=>true, 'null' => true ],
            'pasien_id'                           => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null' => true ],
            'diagnosa'                            => ['type'=>'text','null'=>true],
            'tindakan'                            => ['type'=>'text','null'=>true],
            'terapi'                              => ['type'=>'text','null'=>true],
            'resep_obat'                          => ['type'=>'text','null'=>true],
            'alergi'                              => ['type'=>'text','null'=>true],
            'dokter_id'                           => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null' => true  ],
            'created_at'                          => ['type'=> 'datetime','null'=>true],
            'updated_at'                          => ['type'=> 'datetime','null'=>true],
            
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pendaftarankonsultasi_id' , 'pendaftarankonsultasi', 'id' , 'cascade');
        $this->forge->addForeignKey('pasien_id' , 'pasien', 'id' , 'cascade');
        $this->forge->addForeignKey('dokter_id' , 'dokter', 'id' , 'cascade');
        $this->forge->createTable  ('rekammedis');
    }

    public function down()
    {
        $this->forge->dropTable('rekammedis');
    }
}

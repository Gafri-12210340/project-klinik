<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class DokterTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'email' => 'gafriansyah12@gmail.com',
            'sandi' => '12345678'
        ])->assertStatus(200);
    }

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'dokter', [
            'nama_depan' => 'Testing nama',
            'jenis_kelamin' => 'L',
            'email' => 'testing@email.com',
            'sandi' => 'testing'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "dokter/".$js['id'])
             ->assertStatus(200);
        
        $this->call('patch', 'dokter', [
            'nama' => 'Testing dokter update',
            'jenis_kelamin' => 'L',
            'email' => 'testingupdate@email.com',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'dokter', [
            'id' => $js['id']
        ])->assertStatus(200);

    }

    public function testRead(){
        $this->call('get', 'dokter/all')
             ->assertStatus(200);
    }

    public function testLogout(){
        $this->call('delete', 'login')
             ->assertStatus(302);
    }
    
}

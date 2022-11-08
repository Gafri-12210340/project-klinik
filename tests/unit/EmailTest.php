<?php

use CodeIgniter\Email\Email;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Email as ConfigEmail;

/**
 *  @internal
 */
class EmailTest extends CIUnitTestCase{

    public function testKirimEmail(){
        $email = new Email( new ConfigEmail());
        $email->setFrom('gafriansyah12@gmail.com');
        $email->setTo('velisadavid@gmail.com');
        $email->setSubject('Testing Kirim Email');
        $email->setMessage('Hallo selamat <b>bergabung</b>');

        $this->assertTrue( $email->send() );
    }
}
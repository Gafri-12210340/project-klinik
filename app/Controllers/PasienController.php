<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PasienModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class PasienController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

        $pasien     = (new PasienModel())->where('email', $email)->first();

        if($pasien == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $pasien['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);

        }
        $this->session->set('pasien', $pasien);
        return $this->response->setJSON(['message'=>"selamat datang {$pasien['nama']} "])
                    ->setStatusCode(200);
    }

    public function viewLogin(){
        return view('login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

        $pasien = (new PasienModel())->where('email', $_email)->first();

        if($pasien == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
        $pasien['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new PasienModel())->update($pasien['id'], $pasien);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('admin@gmail.com', 'Sistem Informasi Klinik');
        $email->setTo($pasien['email']);
        $email->setSubject('Reset Sandi Pengguna');
        $email->setMessage("Hallo {$pasien['nama']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"Sandi baru sudah di kirim ke alamat email $_email"])
                        ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email ke $_email"])
                                ->setStatusCode(500);
        }
    }

    public function viewLupaPassword(){
        return view('lupa_password');
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }

    public function index(){
        return view('pasien/table');
    }
      
    public function all(){
        $pm = new PasienModel();
        $pm->select('id, nama');

        return (new Datatable( $pm ))
                ->setFieldFilter(['nama'])
                ->draw();
    }

    public function show($id){
        $r = (new PasienModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new PasienModel();
        $sandi  = $this->request->getvar('sandi');

        $id = $pm->insert([
            'nama'      => $this->request->getvar('nama'),
           
           
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new PasienModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'nama'      => $this->request->getVar('nama'),
         
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new PasienModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}   
    

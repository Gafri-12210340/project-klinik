<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PetugasModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class PetugasController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

       $aa     = (new PetugasModel())->where('email', $email)->first();

        if($aa == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $cekPassword = password_verify($password,$aa['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);

        }
        $this->session->set('petugas',$aa);
        return $this->response->setJSON(['message'=>"selamat datang {$aa['nama_depan']} "])
                    ->setStatusCode(200);
    }

    public function viewLogin(){
        return view('login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

       $aa = (new PetugasModel())->where('email', $_email)->first();

        if($aa == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
       $aa['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new PetugasModel())->update($aa['id'],$aa);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('admin@gmail.com', 'Sistem Informasi Klinik');
        $email->setTo($aa['email']);
        $email->setSubject('Reset Sandi Pengguna');
        $email->setMessage("Hallo {$aa['nama']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
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
        return view('petugas/table');
    }
      
    public function all(){
        $pm = new PetugasModel();
        $pm->select('id, email, nama_lengkap, sandi');

        return (new Datatable( $pm ))
                ->setFieldFilter(['email', 'nama_lengkap', 'sandi'])
                ->draw();
    }

    public function show($id){
        $r = (new PetugasModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new PetugasModel();
        $sandi  = $this->request->getvar('sandi');

        $id = $pm->insert([
            'email'      => $this->request->getvar('email'),
            'nama_lengkap'     => $this->request->getvar('nama_lengkap'),
            'sandi'    => $this->request->getvar('sandi'),
           
           
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new PetugasModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'email'      => $this->request->getVar('email'),
            'nama_lengkap'     => $this->request->getVar('nama_lengkap'),
            'sandi'    => $this->request->getVar('sandi'),
         
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new PetugasModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}   
    

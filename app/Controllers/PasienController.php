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
        return view('backend/pasien/table');
    }
      
    public function all(){
        $pm = new PasienModel();
        $pm->select('id, nama, nama_belakang, no_rekammedik, nik, jenis_kelamin, tgl_lahir, tempat_lahir, alamat, kota, no_telp, email, golongan_darah, sandi, token_reset, ');

        return (new Datatable( $pm ))
                ->setFieldFilter(['nama', 'nama_belakang', 'no_rekammedik', 'nik', 'jenis_kelamin', 'tgl_lahir', 'tempat_lahir', 'alamat', 'kota', 'no_telp', 'email', 'golongan_darah', 'sandi', 'token_reset',])
                ->draw();
    }

    public function show($id){
        $r = (new PasienModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new PasienModel();

        $id = $pm->insert([
            'nama'      => $this->request->getvar('nama'),
            'nama_belakang'      => $this->request->getvar('nama_belakang'),
            'no_rekammedik'      => $this->request->getvar('no_rekammedik'),
            'nik'      => $this->request->getvar('nik'),
            'jenis_kelamin'      => $this->request->getvar('jenis_kelamin'),
            'tgl_lahir'      => $this->request->getvar('tgl_lahir'),
            'tempat_lahir'      => $this->request->getvar('tempat_lahir'),
            'alamat'      => $this->request->getvar('alamat'),
            'kota'      => $this->request->getvar('kota'),
            'no_telp'      => $this->request->getvar('no_telp'),
            'email'      => $this->request->getvar('email'),
            'golongan_darah'      => $this->request->getvar('golongan_darah'),
            'sandi'      => $this->request->getvar('sandi'),
            'token_reset'      => $this->request->getvar('token_reset'),
          
        ]);
        if($id > 0){
            $this->simpanFile($id);
        }

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
            'nama_belakang'      => $this->request->getvar('nama_belakang'),
            'no_rekammedik'      => $this->request->getvar('no_rekammedik'),
            'nik'      => $this->request->getvar('nik'),
            'jenis_kelamin'      => $this->request->getvar('jenis_kelamin'),
            'tgl_lahir'      => $this->request->getvar('tgl_lahir'),
            'tempat_lahir'      => $this->request->getvar('tempat_lahir'),
            'alamat'      => $this->request->getvar('alamat'),
            'kota'      => $this->request->getvar('kota'),
            'no_telp'      => $this->request->getvar('no_telp'),
            'email'      => $this->request->getvar('email'),
            'golongan_darah'      => $this->request->getvar('golongan_darah'),
            'sandi'      => $this->request->getvar('sandi'),
            'token_reset'      => $this->request->getvar('token_reset'),
            

         
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new PasienModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

    private function simpanFile($id){
        $file = $this->request->getFile('berkas');

        if( $file->hasMoved() == false ){
            $direktori = WRITEPATH . 'uploads/pasien';
            if(file_exists($direktori) == false){
                @mkdir($direktori);
            }

            $file->store('pasien', $id . '.jpg');
        }


    }

    public function berkas($id){
        $am = new PasienModel();
        $dt = $am->find($id);
        if($dt == null)throw PageNotFoundException::forPageNotFound();

        $path = WRITEPATH . 'uploads/pasien/' . $id . '.jpg';
        if(file_exists($path) == false){
            throw PageNotFoundException::forPageNotFound();
        }

        echo file_get_contents($path);
        return $this->response->setHeader('Content-type', 'image/jpeg')
                    ->sendBody();
    }

}
    

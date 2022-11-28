<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\DokterModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class DokterController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

        $Dokter     = (new DokterModel())->where('email', $email)->first();

        if($Dokter == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $Dokter['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);

        }
        $this->session->set('dokter', $Dokter);
        return $this->response->setJSON(['message'=>"selamat datang {$Dokter['nama_depan']} "])
                    ->setStatusCode(200);
    }

    public function viewLogin(){
        return view('login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

        $Dokter = (new DokterModel())->where('email', $_email)->first();

        if($Dokter == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
        $Dokter['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new DokterModel())->update($Dokter['id'], $Dokter);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('gafriansyah12@gmail.com', 'Sistem Informasi Klinik');
        $email->setTo($Dokter['email']);
        $email->setSubject('Reset Sandi Pengguna');
        $email->setMessage("Hallo {$Dokter['nama_depan']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
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
        return view('backend/dokter/table');
    }
      
    public function all(){
        $pm = new DokterModel();
        $pm->select('id, nama_depan, nama_belakang, gelar_depan,  jenis_kelamin, tempat_lahir, tgl_lahir, alamat, kota, no_telp_rmh, no_hp, no_wa, email, sandi, no_izin_praktek, tgl_sk_izin,');

        return (new Datatable( $pm ))
                ->setFieldFilter(['nama_depan', 'nama_belakang', 'gelar_depan',  'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'alamat', 'kota', 'no_telp_rmh', 'no_hp', 'no_wa', 'email', 'sandi', 'no_izin_praktek', 'tgl_sk_izin',])
                ->draw();
    }

    public function show($id){
        $r = (new DokterModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new DokterModel();
        $sandi  = $this->request->getvar('sandi');

        $id = $pm->insert([
            'nama_depan'      => $this->request->getvar('nama_depan'),
            'nama_belakang'      => $this->request->getvar('nama_belakang'),
            'gelar_depan'      => $this->request->getvar('gelar_depan'),
            'jenis_kelamin'    => $this->request->getvar('jenis_kelamin'),
            'tempat_lahir'      => $this->request->getvar('tempat_lahir'),
            'tgl_lahir'      => $this->request->getvar('tgl_lahir'),
            'alamat'      => $this->request->getvar('alamat'),
            'kota'      => $this->request->getvar('kota'),
            'no_telp_rmh'      => $this->request->getvar('no_telp_rmh'),
            'no_hp'      => $this->request->getvar('no_hp'),
            'no_wa'      => $this->request->getvar('no_wa'),
            'email'     => $this->request->getvar('email'),
            'sandi'      =>password_hash($sandi, PASSWORD_BCRYPT),
            'no_izin_praktek'      => $this->request->getvar('no_izin_praktek'),
            'tgl_sk_izin'      => $this->request->getvar('tgl_sk_izin'),
             
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new DokterModel();
     
        $id     = (int)$this->request->getvar('id');
        $sandi  = $this->request->getvar('sandi');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'nama_depan'      => $this->request->getvar('nama_depan'),
            'nama_belakang'      => $this->request->getvar('nama_belakang'),
            'gelar_depan'      => $this->request->getvar('gelar_depan'),
            'jenis_kelamin'    => $this->request->getvar('jenis_kelamin'),
            'tempat_lahir'      => $this->request->getvar('tempat_lahir'),
            'tgl_lahir'      => $this->request->getvar('tgl_lahir'),
            'alamat'      => $this->request->getvar('alamat'),
            'kota'      => $this->request->getvar('kota'),
            'no_telp_rmh'      => $this->request->getvar('no_telp_rmh'),
            'no_hp'      => $this->request->getvar('no_hp'),
            'no_wa'      => $this->request->getvar('no_wa'),
            'email'     => $this->request->getvar('email'),
            'sandi'      =>password_hash($sandi, PASSWORD_BCRYPT),
            'no_izin_praktek'      => $this->request->getvar('no_izin_praktek'),
            'tgl_sk_izin'      => $this->request->getvar('tgl_sk_izin'),
         
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new DokterModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}
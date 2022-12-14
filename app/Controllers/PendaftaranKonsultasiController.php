<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PendaftarankonsultasiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class PendaftaranKonsultasiController extends BaseController
{
    public function index()
    {
        return view('backend/pendaftarankonsultasi/table');
    }
    public function all(){
        $kgm = PendaftarankonsultasiModel::view();
         
        return (new Datatable($kgm))
        ->setFieldFilter([ 'tgl', 'no_antrian', 'berat_badan', 'tinggi_badan', 'temp_badan', 'lingkar_kepala', 'keluhan', ])
        ->draw();
    }
    public function show($id){
        $r = (new PendaftarankonsultasiModel()) -> where('id' ,  $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $kgm = new PendaftarankonsultasiModel();
        $id = $kgm -> insert ([
            'tgl'    => $this->request->getVar('tgl'),
            'jadwalpraktek_id'   => $this->request->getVar('jadwalpraktek_id'),
            'pasien_id'      => $this->request->getVar('pasien_id'),
            'petugas_id'     => $this->request->getVar('petugas_id'),
            'no_antrian'     => $this->request->getVar('no_antrian'),
            'berat_badan'     => $this->request->getVar('berat_badan'),
            'tinggi_badan'     => $this->request->getVar('tinggi_badan'),
            'temp_badan'     => $this->request->getVar('temp_badan'),
            'lingkar_kepala'     => $this->request->getVar('lingkar_kepala'),
            'keluhan'     => $this->request->getVar('keluhan'),
            

        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $kgm = new PendaftarankonsultasiModel();
        $id = (int)$this->request->getVar('id');
        if($kgm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $kgm->update($id,[
            'tgl'    => $this->request->getVar('tgl'),
            'jadwalpraktek_id'   => $this->request->getVar('jadwalpraktek_id'),
            'pasien_id'      => $this->request->getVar('pasien_id'),
            'petugas_id'     => $this->request->getVar('petugas_id'),
            'no_antrian'     => $this->request->getVar('no_antrian'),
            'berat_badan'     => $this->request->getVar('berat_badan'),
            'tinggi_badan'     => $this->request->getVar('tinggi_badan'),
            'temp_badan'     => $this->request->getVar('temp_badan'),
            'lingkar_kepala'     => $this->request->getVar('lingkar_kepala'),
            'keluhan'     => $this->request->getVar('keluhan'),
            
        ]);
    }
    public function delete(){
        $kgm    = new PendaftarankonsultasiModel();
        $id     = $this->request->getVar('id');
        $hasil  = $kgm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }
}
<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\JasaBarangModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class JasaBarangController extends BaseController
{
    
    public function index()
    {
        return view('backend/jasabarang/table');       
    }
    public function all(){
        $mm = new JasaBarangModel();
        $mm->select(['id', 'nama', 'jenis', 'harga', 'keterangan']);
        
        return (new Datatable ($mm))
                ->setFieldFilter(['nama', 'jenis', 'harga', 'keterangan'])
                ->draw();
    }
    public function show($id){
        $r = (new JasaBarangModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $mm = new JasaBarangModel();

        $id =  $mm -> insert([
            'nama'       => $this->request->getVar('nama'),
            'jenis'    => $this->request->getVar('jenis'),
            'harga'  => $this->request->getVar('harga'),
            'keterangan'     => $this->request->getVar('keterangan'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $mm = new JasaBarangModel();
        $id = (int)$this->request->getVar('id');
        
        if($mm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $mm->update($id,[
            'nama'       => $this->request->getVar('nama'),
            'jenis'    => $this->request->getVar('jenis'),
            'harga'  => $this->request->getVar('harga'),
            'keterangan'     => $this->request->getVar('keterangan'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $mm = new JasaBarangModel();
        $id = $this->request->getVar('id');
        $hasil = $mm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}

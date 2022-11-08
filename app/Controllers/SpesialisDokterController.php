<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\SpesialisDokterModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;


use function PHPUnit\Framework\returnSelf;

class SpesialisDokterController extends BaseController
{
    
    public function index()
    {
        return view('spesialisdokter/table');       
    }
    public function all(){
        $kgm = SpesialisDokterModel::view();
         
        return (new Datatable($kgm))
        ->setFieldFilter([ 'nama_depan'])
        ->draw();
    }
    public function show($id){
        $r = (new SpesialisDokterModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $mm = new SpesialisDokterModel();

        $id =  $mm -> insert([
            'dokter_id'       => $this->request->getVar('dokter_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $mm = new SpesialisDokterModel();
        $id = (int)$this->request->getVar('id');
        
        if($mm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $mm->update($id,[
            'dokter_id'       => $this->request->getVar('dokter_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $mm = new SpesialisDokterModel();
        $id = $this->request->getVar('id');
        $hasil = $mm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}
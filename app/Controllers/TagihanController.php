<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\TagihanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class TagihanController extends BaseController
{
    
    public function index()
    {
        return view('backend/tagihan/table');       
    }
    public function all(){
        $mm = TagihanModel::view();
        
        return (new Datatable ($mm))
                ->setFieldFilter(['tgl', 'subtotal', 'ppn', 'nama_lengkap'])
                ->draw();
    }
    public function show($id){
        $r = (new TagihanModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $mm = new TagihanModel();

        $id =  $mm -> insert([
            'tgl'    => $this->request->getVar('tgl'),
            'subtotal'  => $this->request->getVar('subtotal'),
            'ppn'     => $this->request->getVar('ppn'),
            'petugas_id'     => $this->request->getVar('petugas_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $mm = new TagihanModel();
        $id = (int)$this->request->getVar('id');
        
        if($mm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $mm->update($id,[
            'tgl'    => $this->request->getVar('tgl'),
            'subtotal'  => $this->request->getVar('subtotal'),
            'ppn'     => $this->request->getVar('ppn'),
            'petugas_id'     => $this->request->getVar('petugas_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $mm = new TagihanModel();
        $id = $this->request->getVar('id');
        $hasil = $mm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}

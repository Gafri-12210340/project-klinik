<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\RincianTagihanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnSelf;

class RincianTagihanController extends BaseController
{
    
    public function index()
    {
        return view('backend/rinciantagihan/table');       
    }
    public function all(){
        $mm = RincianTagihanModel::view();
      
        
        return (new Datatable ($mm))
                ->setFieldFilter(['subtotal', 'nama', 'qty', 'harga'])
                ->draw();
    }
    public function show($id){
        $r = (new RincianTagihanModel())->where('id', $id)->first();
        if ($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $mm = new RincianTagihanModel();

        $id =  $mm -> insert([
            'tagihan_id'       => $this->request->getVar('tagihan_id'),
            'jasabarang_id'    => $this->request->getVar('jasabarang_id'),
            'qty'     => $this->request->getVar('qty'),
            'harga'     => $this->request->getVar('harga'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode(intval($id)> 0 ? 200 : 406);  
    }
    public function update(){
        $mm = new RincianTagihanModel();
        $id = (int)$this->request->getVar('id');
        
        if($mm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();
        
        $hasil = $mm->update($id,[
            'tagihan_id'       => $this->request->getVar('tagihan_id'),
            'jasabarang_id'    => $this->request->getVar('jasabarang_id'),
            'qty'     => $this->request->getVar('qty'),
            'harga'     => $this->request->getVar('harga'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $mm = new RincianTagihanModel();
        $id = $this->request->getVar('id');
        $hasil = $mm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }    
}

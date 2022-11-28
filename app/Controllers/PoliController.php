<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PoliModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnself;

class PoliController extends BaseController
{
    public function index(){
        return view('backend/Poli/table');
    }

    public function all(){
        $pm = new PoliModel();
        $pm->select('id, nama, deskripsi');

        return (new Datatable( $pm ))
                ->setFieldFilter(['id', 'nama', 'deskripsi'])
                ->draw();
    }

    public function show($id){
        $r = (new PoliModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm     = new PoliModel();
        $sandi  = $this->request->getvar('sandi');

        $id = $pm->insert([
            'nama'      => $this->request->getvar('nama'),
            'deskripsi'    => $this->request->getvar('deskripsi'),
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new PoliModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'nama'      => $this->request->getVar('nama'),
            'deskripsi'    => $this->request->getVar('deskripsi'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new PoliModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}

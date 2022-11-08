<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\SpesialisModel;
use CodeIgniter\Exception\PageNotFoundException;
use CodeIgniter\Exceptions\PageNotFoundException as ExceptionsPageNotFoundException;

use function PHPUnit\Framework\returnself;

class SpesialisController extends BaseController
{

    public function index(){
        return view('spesialis/table');
    }

    public function all(){
        $pm = new SpesialisModel();
        $pm->select('id, nama, gelar');

        return (new Datatable( $pm ))
                ->setFieldFilter(['nama', 'gelar'])
                ->draw();
    }

    public function show($id){
        $r = (new SpesialisModel())->where('id', $id)->first();
        if($r == null)throw ExceptionsPageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm     = new SpesialisModel();

        $id = $pm->insert([
            'nama'      => $this->request->getvar('nama'),
            'gelar'    => $this->request->getvar('gelar'),
    
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new SpesialisModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw ExceptionsPageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'nama'      => $this->request->getVar('nama'),
            'gelar'    => $this->request->getVar('gelar'),
        
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new SpesialisModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}
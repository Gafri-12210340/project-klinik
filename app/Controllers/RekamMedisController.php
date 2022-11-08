<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\RekamMedisModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnself;

class RekamMedisController extends BaseController
{
    public function index(){
        return view('rekammedis/table');
    }

    public function all(){
        $pm = new RekamMedisModel();
        $pm->select('id, diagnosa, tindakan, resep_obat');

        return (new Datatable( $pm ))
                ->setFieldFilter(['diagnosa, tindakan, resep_obat'])
                ->draw();
    }

    public function show($id){
        $r = (new RekamMedisModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm     = new RekamMedisModel();
        $sandi  = $this->request->getvar('sandi');

        $id = $pm->insert([
            'diagnosa'      => $this->request->getvar('diagnosa'),
            'tindakan'      => $this->request->getvar('tindakan'),
            'resep_obat'    => $this->request->getvar('resep_obat'),
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new RekamMedisModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'diagnosa'      => $this->request->getvar('diagnosa'),
            'tindakan'      => $this->request->getvar('tindakan'),
            'resep_obat'    => $this->request->getvar('resep_obat'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new RekamMedisModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}

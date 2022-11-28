<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\JadwalPraktekModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnself;

class JadwalPraktekController extends BaseController
{
    public function index(){
        return view('backend/jadwalpraktek/table');
    }

    public function all(){
        $pm = new JadwalPraktekModel();
        $pm->select('id, polidokter_id, hari , jam_mulai, jam_selesai');

        return (new Datatable( $pm ))
                ->setFieldFilter(['poli_id', 'hari', 'jam_mulai', 'jam_selesai'])
                ->draw();
    }

    public function show($id){
        $r = (new JadwalPraktekModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new JadwalPraktekModel();

        $id = $pm->insert([
            'polidokter_id'      => $this->request->getvar('polidokter_id'),
            'hari'    => $this->request->getvar('hari'),
            'jam_mulai'    => $this->request->getvar('jam_mulai'),
            'jam_selesai'    => $this->request->getvar('jam_selesai'),
            
            
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new JadwalPraktekModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'polidokter_id'      => $this->request->getVar('polidokter_id'),
            'hari'    => $this->request->getVar('hari'),
            'jam_mulai'    => $this->request->getvar('jam_mulai'),
            'jam_selesai'    => $this->request->getvar('jam_selesai'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new JadwalPraktekModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}

<?php
namespace App\Controllers;

use App\Models\ModelDataMobil;

class DataMobil extends BaseController
{
    public function index()
    {
        $model = new ModelDataMobil();
        $db = db_connect();
        $query = $db->table('datamobil')->select('status')->distinct()->get()->getResultArray();
        $data['status'] = $query;
        $data['datamobil'] = $model->getDataMobil()->getResultArray();
        echo view('datamobil/v_datamobil', $data);
    }


    public function save()
    {
        $model = new ModelDataMobil();
        $data = array(
            'idmobil'  => $this->request->getPost('id'),
            'merek' => $this->request->getPost('merek'),
            'tahun'        => $this->request->getPost('tahun'),
            'noplat'         => $this->request->getPost('noplat'),
            'status'        => $this->request->getPost('status'),
            'hrgsewa'         => $this->request->getPost('hrgsewa'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[datamobil.idmobil]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} Sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        try {
            $model->insertData($data);
            session()->setFlashdata('success', 'Data mobil berhasil ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menambahkan data mobil');
        }
        return redirect()->to('/datamobil');
    }

    public function delete()
    {
        $model = new ModelDataMobil();
        $id = $this->request->getpost('id');
        $model->deletDataMobil($id);
        session()->setFlashdata('success','Data Mobil Berhasil Dihapus');
        return redirect()->to('/datamobil');
    }

    function update()
{
    $model = new ModelDataMobil();
    $id = $this->request->getPost('id');
    $data = array(
        'idmobil' => $this->request->getPost('id'),
        'merek' => $this->request->getPost('merek'),
        'tahun' => $this->request->getPost('tahun'),
        'noplat' => $this->request->getPost('noplat'),
        'status' => $this->request->getPost('status'),
        'hrgsewa' => $this->request->getPost('hrgsewa'),
    );
    $model->updateDataMobil($data, $id);
    session()->setFlashdata('success', 'Data Mobil Berhasil Diubah');
    return redirect()->to('/datamobil');
}
}

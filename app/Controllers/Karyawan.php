<?php
namespace App\Controllers;

use App\Models\ModelKaryawan;

class Karyawan extends BaseController
{
    public function index()
    {
        $model = new ModelKaryawan();
        $data['karyawan'] = $model->getKaryawan()->getResultArray();
        echo view('karyawan/v_karyawan', $data);
    }


    public function save()
    {
        $model = new ModelKaryawan();
        $data = array(
            'idkaryawan'  => $this->request->getPost('id'),
            'nama' => $this->request->getPost('nama'),
            'nohp'        => $this->request->getPost('nohp'),
            'nointitas'         => $this->request->getPost('nointitas'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[karyawan.idkaryawan]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} Sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $model->insertData($data);
            session()->setFlashdata('success', 'Data Karyawan Berhasil Ditambahkan');
            return redirect()->to('/karyawan');
        }

      
    }

    public function delete()
    {
        $model = new ModelKaryawan();
        $id = $this->request->getpost('id');
        $model->deletKaryawan($id);
        session()->setFlashdata('success', 'Data Karyawan Berhasil Dihapus');
        return redirect()->to('/karyawan');
    }

    function update()
{
    $model = new ModelKaryawan();
    $id = $this->request->getPost('id');
    $data = array(
        'idkaryawan' => $this->request->getPost('id'),
        'nama' => $this->request->getPost('nama'),
        'nohp' => $this->request->getPost('nohp'),
        'nointitas' => $this->request->getPost('nointitas'),
    );
    $model->updateKaryawan($data, $id);
    session()->setFlashdata('success', 'Data Karyawan Berhasil Diubah');
    return redirect()->to('/karyawan');
}
}
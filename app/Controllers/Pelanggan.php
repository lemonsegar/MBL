<?php
namespace App\Controllers;

use App\Models\ModelPelanggan;

class Pelanggan extends BaseController
{
    public function index()
    {
        $model = new ModelPelanggan();
        $data['pelanggan'] = $model->getPelanggan()->getResultArray();
        echo view('pelanggan/v_pelanggan', $data);
    }


    public function save()
    {
        $model = new ModelPelanggan();
        $data = array(
            'idpel'  => $this->request->getPost('id'),
            'nama' => $this->request->getPost('nama'),
            'alamat'        => $this->request->getPost('alamat'),
            'nohp'         => $this->request->getPost('nohp'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[pelanggan.idpel]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} Sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }

        $model->insertData($data);
        return redirect()->to('/pelanggan');
    }

    public function delete()
    {
        $model = new ModelPelanggan();
        $id = $this->request->getpost('id');
        $model->deletPelanggan($id);
        return redirect()->to('/pelanggan/index');
    }

    function update()
{
    $model = new ModelPelanggan();
    $id = $this->request->getPost('id');
    $data = array(
        'idpel' => $this->request->getPost('id'),
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'nohp' => $this->request->getPost('nohp'),
    );
    $model->updatePelanggan($data, $id);
    return redirect()->to('/pelanggan/index');
}
}
?>
<?php
namespace App\Controllers;
use App\Models\ModelPeminjam;

class Peminjam extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == true) 
            and (session()->get('level') == 1 or session()->get('level') == 3)) 
        {
            $model = new ModelPeminjam();
            $data['peminjam'] = $model->getPeminjam()->getResultArray();
            $data['data_pel'] = $model->getPel()->getResultArray();
            $data['data_mobil'] = $model->getMobil()->getResultArray();
            echo view('peminjam/v_peminjam', $data);
        } 
        else 
        {
            echo "<script>alert('Anda belum login'); window.location.href='/login';</script>";
        }
    }

    public function save()
 {
    $model = new ModelPeminjam();
    $data = array(
        'tanggal' => $this->request->getPost('tanggal'),
        'idpel' => $this->request->getPost('idpel'),
        'idmobil' => $this->request->getPost('idmobil'),
        'lama' => $this->request->getPost('lama'),
        'total' => $this->request->getPost('total'),
    );

    $model->insertData($data);
    return redirect()->to('/peminjam');
 }
public function delete()
 {
    $model = new ModelPeminjam();
    $id = $this->request->getpost('idpeminjam');
    $model->deletPeminjam($id);
    return redirect()->to('/peminjam/index');
 }

function update()
 {
    $model = new ModelPeminjam();
    $id = $this->request->getPost('id');
    $data = array(
        'tanggal' => $this->request->getPost('tanggal'),
        'idpel' => $this->request->getPost('idpel'),
        'idmobil' => $this->request->getPost('idmobil'),
        'lama' => $this->request->getPost('lama'),
        'total' => $this->request->getPost('total'),
    );
    $model->updatePeminjam($data, $id);
    return redirect()->to('/peminjam/index');
 }
}
?>
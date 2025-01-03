<?php
namespace App\Controllers;

use App\Models\ModelUser;

class User extends BaseController
{
    public function index()
    {
        $model = new ModelUser();
        $data['user'] = $model->getUser()->getResultArray();
        echo view('user/v_user', $data);
    }

    public function save()
    {
        $model = new ModelUser();
        $data = array(
            'id_user'  => $this->request->getPost('id'),
            'nama_user' => $this->request->getPost('namauser'),
            'email'       => $this->request->getPost('email'),
            'password'        => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT),
            'level'         => $this->request->getPost('level'),
        );
        $model->insertData($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('/user');
    }

    public function delete()
    {
        $model = new ModelUser();
        $id = $this->request->getpost('id');
        $model->deletUser($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/user');
    }

    function update()
    {
    $model = new ModelUser();
    $id = $this->request->getPost('id');
    $data = array(
        'nama_user' => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT),
        'level' => $this->request->getPost('level'),
    );
    $model->updateuser($data, $id);
    session()->setFlashdata('success', 'Data berhasil diubah');
    return redirect()->to('/user');
    }

}
?>
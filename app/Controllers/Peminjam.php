<?php

namespace App\Controllers;

use App\Models\ModelDataMobil;
use App\Models\ModelPeminjam;

class Peminjam extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1 or session()->get('level') == 3)
        ) {
            $model = new ModelPeminjam();
            $data['peminjam'] = $model->getPeminjam()->getResultArray();
            $data['data_pel'] = $model->getPel()->getResultArray();
            $data['data_mobil'] = $model->getMobil()->getResultArray();
            echo view('peminjam/v_peminjam', $data);
        } else {
            echo "<script>alert('Anda belum login'); window.location.href='/login';</script>";
        }
    }

    public function tambah()
    {
        $model = new ModelPeminjam();
        $data['data_pel'] = $model->getPel()->getResultArray();
        $data['data_mobil'] = $model->getMobil()->getResultArray();
        echo view('peminjam/formtambah', $data);
    }

    public function save()
    {
        $model = new ModelPeminjam();
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal harus diisi']
            ],
            'idpel' => [
                'rules' => 'required',
                'errors' => ['required' => 'Pelanggan harus dipilih']
            ],
            'idmobil' => [
                'rules' => 'required', 
                'errors' => ['required' => 'Mobil harus dipilih']
            ],
            'lama' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Lama sewa harus diisi',
                    'numeric' => 'Lama sewa harus berupa angka',
                    'greater_than' => 'Lama sewa harus lebih dari 0'
                ]
            ],
            'total' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Total bayar harus diisi',
                    'numeric' => 'Total bayar harus berupa angka',
                    'greater_than' => 'Total bayar harus lebih dari 0'
                ]
            ],
            'tglkembali' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal kembali harus diisi']
            ]
        ]);

        // Jika validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->back()->withInput();
        }

        // Jika validasi berhasil
        $data = array(
            'tanggal' => $this->request->getPost('tanggal'),
            'idpel' => $this->request->getPost('idpel'), 
            'idmobil' => $this->request->getPost('idmobil'),
            'lama' => $this->request->getPost('lama'),
            'total' => $this->request->getPost('total'),
            'tanggalkembali' => $this->request->getPost('tglkembali'),
        );

        $model->insertData($data);

        $modelmobil = new ModelDataMobil();
        $modelmobil->updateMobil($data['idmobil'], ['status' => 'Tidak Tersedia']);

        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('/peminjam');
    }
    public function delete()
    {
        $model = new ModelPeminjam();
        $id = $this->request->getpost('idpeminjam');
        $idmobil = $this->request->getpost('idmobil');
        $modelmobil = new ModelDataMobil();
        $modelmobil->updateMobil($idmobil, ['status' => 'Tersedia']);
        $model->deletPeminjam($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/peminjam');
    }

    public function edit()
    {
        $model = new ModelPeminjam();
        $id = $this->request->getPost('id');
        $data['peminjam'] = $model->getPeminjam($id)->getRowArray();
        $data['data_pel'] = $model->getPel()->getResultArray();
        $data['data_mobil'] = $model->getMobil()->getResultArray();
        echo view('peminjam/formedit', $data);
    }

    function update()
    {
        $model = new ModelPeminjam();
        $modelmobil = new ModelDataMobil();
        
        $id = $this->request->getPost('id');
        $idmobil = $this->request->getPost('idmobil');
        
        // Ambil data peminjaman lama untuk mendapatkan idmobil sebelumnya
        $oldData = $model->getPeminjam($id)->getRowArray();
        $oldIdMobil = $oldData['idmobil'];

        $data = array(
            'tanggal' => $this->request->getPost('tanggal'),
            'idpel' => $this->request->getPost('idpel'),
            'idmobil' => $idmobil,
            'lama' => $this->request->getPost('lama'),
            'total' => $this->request->getPost('total'),
            'tanggalkembali' => $this->request->getPost('tglkembali'),
        );

        // Update data peminjaman
        $model->updatePeminjam($data, $id);

        // Jika idmobil berubah
        if($oldIdMobil != $idmobil) {
            // Update status mobil lama menjadi Tersedia
            $modelmobil->updateMobil($oldIdMobil, ['status' => 'Tersedia']);
            
            // Update status mobil baru menjadi Tidak Tersedia
            $modelmobil->updateMobil($idmobil, ['status' => 'Tidak Tersedia']);
        }
      
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/peminjam/index');
    }
}

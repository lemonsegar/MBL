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
            'alamat' => $this->request->getPost('alamat'),
            'nohp'   => $this->request->getPost('nohp'),
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
        }

        try {
            $model->insertData($data);
            session()->setFlashdata('success', 'Data pelanggan berhasil ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menambahkan data pelanggan');
        }
        return redirect()->to('/pelanggan');
    }

    public function delete()
    {
        $model = new ModelPelanggan();
        $id = $this->request->getPost('id');
        try {
            $model->deletPelanggan($id);
            session()->setFlashdata('success', 'Data pelanggan berhasil dihapus');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus data pelanggan');
        }
        return redirect()->to('/pelanggan');
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
        try {
            $model->updatePelanggan($data, $id);
            session()->setFlashdata('success', 'Data pelanggan berhasil diperbarui');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memperbarui data pelanggan');
        }
        return redirect()->to('/pelanggan');
    }

    public function laporan()
    {
        $model = new ModelPelanggan();
        $data['pelanggan'] = $model->getPelanggan()->getResultArray();
        echo view('pelanggan/v_laporan', $data);
    }

    public function filter()
    {
        if ($this->request->isAJAX()) {
            $idpel_awal = $this->request->getPost('idpel_awal');
            $idpel_akhir = $this->request->getPost('idpel_akhir');

            $db = \Config\Database::connect();
            $builder = $db->table('pelanggan');

            $data = $builder->where('idpel >=', $idpel_awal)
                ->where('idpel <=', $idpel_akhir)
                ->orderBy('idpel', 'ASC')
                ->get()
                ->getResultArray();

            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid Request'
        ]);
    }


    public function cetakpdf()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pelanggan');

        // Ambil parameter filter jika ada
        $idpel_awal = $this->request->getGet('idpel_awal');
        $idpel_akhir = $this->request->getGet('idpel_akhir');

        if ($idpel_awal && $idpel_akhir) {
            $builder->where('idpel >=', $idpel_awal)
                ->where('idpel <=', $idpel_akhir);
        }

        $data['pelanggan'] = $builder->orderBy('idpel', 'ASC')
        ->get()
            ->getResultArray();

        $data['title'] = 'Laporan Data Pelanggan';
        $data['tgl_cetak'] = date('d/m/Y');

        $dompdf = new \Dompdf\Dompdf();
        $html = view('pelanggan/cetak_pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_pelanggan.pdf', ['Attachment' => false]);
    }


    
}

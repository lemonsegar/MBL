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

public function laporan()
{
    $model = new ModelKaryawan();
    $data['karyawan'] = $model->getKaryawan()->getResultArray();
    echo view('karyawan/v_laporan', $data);
}

    public function filter()
    {
        if ($this->request->isAJAX()) {
            try {
                $idkaryawan_awal = $this->request->getPost('idkaryawan_awal');
                $idkaryawan_akhir = $this->request->getPost('idkaryawan_akhir');

                $db = \Config\Database::connect();
                $builder = $db->table('karyawan');

                $data = $builder->where('idkaryawan >=', $idkaryawan_awal)
                    ->where('idkaryawan <=', $idkaryawan_akhir)
                    ->orderBy('idkaryawan', 'ASC')
                    ->get()
                    ->getResultArray();

                return $this->response->setJSON([
                    'success' => true,
                    'data' => $data
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid Request'
        ]);
    }

    public function cetakpdf()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('karyawan');

        // Ambil parameter filter jika ada
        $idkaryawan_awal = $this->request->getGet('idkaryawan_awal');
        $idkaryawan_akhir = $this->request->getGet('idkaryawan_akhir');

        if ($idkaryawan_awal && $idkaryawan_akhir) {
            $builder->where('idkaryawan >=', $idkaryawan_awal)
                ->where('idkaryawan <=', $idkaryawan_akhir);
        }

        $data['karyawan'] = $builder->orderBy('idkaryawan', 'ASC')
            ->get()
            ->getResultArray();

        $data['title'] = 'Laporan Data Karyawan';
        $data['tgl_cetak'] = date('d/m/Y');

        $dompdf = new \Dompdf\Dompdf();
        $html = view('karyawan/cetak_pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_karyawan.pdf', ['Attachment' => false]);
    }
}
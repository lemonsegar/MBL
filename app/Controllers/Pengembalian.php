<?php

namespace App\Controllers;

use App\Models\ModelDataMobil;
use App\Models\ModelPeminjam;
use App\Models\ModelPengembalian;

class Pengembalian extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1 or session()->get('level') == 3)
        ) {
            $model = new ModelPengembalian();
            $data['pengembalian'] = $model->getPengembalian()->getResultArray();
            $data['data_peminjaman'] = $model->getPeminjaman()->getResultArray();

           
            echo view('pengembalian/v_pengembalian', $data);
        } else {
            echo "<script>alert('Anda belum login'); window.location.href='/login';</script>";
        }
    }

    public function tambah()
    {
        $model = new ModelPengembalian();
        $data['data_peminjaman'] = $model->getPeminjaman()->getResultArray();
        echo view('pengembalian/formtambah', $data);
    }

    public function save()
    {
        $model = new ModelPengembalian();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'faktur' => [
                'rules' => 'required',
                'errors' => ['required' => 'Faktur peminjaman harus dipilih']
            ],
            'tgldikembalikan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal dikembalikan harus diisi']
            ],
            'denda' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Denda harus diisi',
                    'numeric' => 'Denda harus berupa angka',
                    'greater_than_equal_to' => 'Denda tidak boleh negatif'
                ]
            ]
        ]);

        // Jika validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->back()->withInput();
        }

        // Jika validasi berhasil
        $data = array(
            'faktur' => $this->request->getPost('faktur'),
            'tgldikembalikan' => $this->request->getPost('tgldikembalikan'),
            'denda' => $this->request->getPost('denda')
        );

        // Simpan data pengembalian
        $model->insertData($data);

        // Update status mobil menjadi Tersedia
        
        $peminjaman = $model->getPeminjamanByFaktur($data['faktur'])->getRowArray();
        $modelmobil = new ModelDataMobil();
        $modelmobil->updateMobil($peminjaman['idmobil'], ['status' => 'Tersedia']);

        session()->setFlashdata('success', 'Data pengembalian berhasil ditambahkan');
        return redirect()->to('/pengembalian');
    }
    public function delete()
    {
        $model = new ModelPengembalian();
        $id = $this->request->getpost('idkembali');
        $model->deletPengembalian($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/pengembalian');
    }

    public function edit()
    {
        $model = new ModelPengembalian();
        $idkembali = $this->request->getpost('idkembali');
        $data['pengembalian'] = $model->getPengembalian($idkembali)->getRowArray();
        $data['data_peminjaman'] = $model->getPeminjaman()->getResultArray();
        echo view('pengembalian/formedit', $data);
    }

    function update()
    {
        $model = new ModelPengembalian();
        
        $idkembali = $this->request->getPost('idkembali');
        
        $data = array(
            'tgldikembalikan' => $this->request->getPost('tgldikembalikan'),
            'denda' => $this->request->getPost('denda')
        );

        // Update data pengembalian
        $model->updatePengembalian($data, $idkembali);

        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/pengembalian');
    }


    public function laporan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pengembalian pg')
        ->select('pg.*, p.tanggal, p.tanggalkembali, p.total, p.lama, 
                 pl.nama as nama_pelanggan, m.merek, m.noplat')
        ->join('peminjaman p', 'p.faktur = pg.faktur')
        ->join('pelanggan pl', 'pl.idpel = p.idpel')
        ->join('datamobil m', 'm.idmobil = p.idmobil')
        ->orderBy('pg.tgldikembalikan', 'DESC');

        $data = [
            'title' => 'Laporan Pengembalian',
            'pengembalian' => $builder->get()->getResultArray()
        ];

        return view('pengembalian/v_laporan', $data);
    }

    public function filter()
    {
        if ($this->request->isAJAX()) {
            try {
                $tanggal_awal = $this->request->getPost('tanggal_awal');
                $tanggal_akhir = $this->request->getPost('tanggal_akhir');

                $db = \Config\Database::connect();
                $builder = $db->table('pengembalian pg')
                ->select('pg.*, p.tanggal, p.tanggalkembali, p.total, p.lama, 
                         pl.nama as nama_pelanggan, m.merek, m.noplat')
                ->join('peminjaman p', 'p.faktur = pg.faktur')
                ->join('pelanggan pl', 'pl.idpel = p.idpel')
                ->join('datamobil m', 'm.idmobil = p.idmobil')
                ->where('pg.tgldikembalikan >=', $tanggal_awal)
                    ->where('pg.tgldikembalikan <=', $tanggal_akhir)
                    ->orderBy('pg.tgldikembalikan', 'DESC');

                $data = $builder->get()->getResultArray();

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
        $builder = $db->table('pengembalian pg')
        ->select('pg.*, p.tanggal, p.tanggalkembali, p.total, p.lama, 
                 pl.nama as nama_pelanggan, m.merek, m.noplat')
        ->join('peminjaman p', 'p.faktur = pg.faktur')
        ->join('pelanggan pl', 'pl.idpel = p.idpel')
        ->join('datamobil m', 'm.idmobil = p.idmobil');

        // Ambil parameter filter jika ada
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        if ($tanggal_awal && $tanggal_akhir) {
            $builder->where('pg.tgldikembalikan >=', $tanggal_awal)
                ->where('pg.tgldikembalikan <=', $tanggal_akhir);
        }

        $data['pengembalian'] = $builder->orderBy('pg.tgldikembalikan', 'DESC')
        ->get()
            ->getResultArray();

        $data['title'] = 'Laporan Data Pengembalian';
        $data['tgl_cetak'] = date('d/m/Y');
        $data['periode'] = $tanggal_awal && $tanggal_akhir ?
            'Periode: ' . date('d/m/Y', strtotime($tanggal_awal)) . ' - ' . date('d/m/Y', strtotime($tanggal_akhir)) :
            'Semua Periode';

        $dompdf = new \Dompdf\Dompdf();
        $html = view('pengembalian/cetak_pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_pengembalian.pdf', ['Attachment' => false]);
    }
}

<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelPeminjam extends Model
{
    public function getPeminjam()
    {
        $builder = $this->db->table('peminjaman');
        
        $builder->select('peminjaman.*, pelanggan.idpel, pelanggan.nama, pelanggan.nohp, datamobil.noplat, datamobil.hrgsewa');
        $builder->join('pelanggan', 'peminjaman.idpel = pelanggan.idpel', 'left');
        $builder->join('datamobil', 'peminjaman.idmobil = datamobil.idmobil', 'left');
        
        // Kembalikan hasil query
        return $builder->get();
    }

    public function getPel()
    {
        $builder = $this->db->table('pelanggan');
        return $builder->get();
    }

    public function getMobil()
    {
        $builder = $this->db->table('datamobil')->where('status', 'Tersedia');
        return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('peminjaman')->insert($data);
    }

    public function deletPeminjam($id)
    {
        $query = $this->db->table('peminjaman')->delete(array('idpeminjam' => $id));
        return $query;
    }

    public function updatePeminjam($data, $id)
    {
        $query = $this->db->table('peminjaman')->update($data, array('idpeminjam' => $id));
    }

    public function getFaktur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(faktur,4)) as nofaktur 
                                  FROM peminjaman 
                                  WHERE DATE(tanggal) = CURDATE()");
        $hasil = $query->getRow();
        $nofaktur = $hasil->nofaktur;

        if ($nofaktur > 0) {
            $no = (int) $nofaktur;
            $no++;
        } else {
            $no = 1;
        }

        $faktur = "TRX-" . $tgl . sprintf('%04s', $no);
        return $faktur;
    }
}

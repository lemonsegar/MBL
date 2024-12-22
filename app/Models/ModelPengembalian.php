<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengembalian extends Model
{
    public function getPengembalian()
    {
        $builder = $this->db->table('pengembalian');

        $builder->select('pengembalian.*,tanggal,lama,total,tanggalkembali,denda,pelanggan.idpel, pelanggan.nama, pelanggan.nohp, datamobil.noplat, datamobil.hrgsewa');
        $builder->join('peminjaman', 'pengembalian.faktur = peminjaman.faktur', 'left');
        $builder->join('pelanggan', 'peminjaman.idpel = pelanggan.idpel', 'left');
        $builder->join('datamobil', 'peminjaman.idmobil = datamobil.idmobil', 'left');

        // Kembalikan hasil query
        return $builder->get();
    }

    public function getPeminjaman()
    {
        $builder = $this->db->table('peminjaman')
        ->join('pelanggan', 'peminjaman.idpel = pelanggan.idpel', 'left')
        ->join('datamobil', 'peminjaman.idmobil = datamobil.idmobil', 'left');
        return $builder->get();
    }

  

    public function insertData($data)
    {
        $this->db->table('pengembalian')->insert($data);
    }

    public function deletPengembalian($id)
    {
        $query = $this->db->table('pengembalian')->delete(array('idkembali' => $id));
        return $query;
    }

   
    public function updatePengembalian($data, $idkembali)
    {
        $query = $this->db->table('pengembalian')->update($data, array('idkembali' => $idkembali));
        return $query;
    }
    public function getPeminjamanByFaktur($faktur)
    {
        return $this->db->table('peminjaman')->where('faktur', $faktur)->get();
    }
}

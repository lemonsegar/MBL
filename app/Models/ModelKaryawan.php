<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelKaryawan extends Model
{
    public function getKaryawan()
    {
      $builder = $this->db->table('karyawan');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('karyawan')->insert($data);
    }

    public function deletKaryawan($id)
    {
        $query = $this->db->table('karyawan')->delete(array('idkaryawan' => $id));
        return $query;
    }

    public function updateKaryawan($data, $id)
    {
        $query = $this->db->table('karyawan')->update($data, array('idkaryawan' => $id));
    }
}
?>
<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    public function getPelanggan()
    {
      $builder = $this->db->table('pelanggan');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('pelanggan')->insert($data);
    }

    public function deletPelanggan($id)
    {
        $query = $this->db->table('Pelanggan')->delete(array('idpel' => $id));
        return $query;
    }

    public function updatePelanggan($data, $id)
    {
        $query = $this->db->table('Pelanggan')->update($data, array('idpel' => $id));
    }
}
?>
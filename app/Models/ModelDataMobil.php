<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelDataMobil extends Model
{
    public function getDataMobil()
    {
      $builder = $this->db->table('datamobil');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('datamobil')->insert($data);
    }

    public function deletDataMobil($id)
    {
        $query = $this->db->table('datamobil')->delete(array('idmobil' => $id));
        return $query;
    }

    public function updateDataMobil($data, $id)
    {
        $query = $this->db->table('datamobil')->update($data, array('idmobil' => $id));
    }

    public function updateMobil($id, $data)
    {
        $this->db->table('datamobil')->update($data, array('idmobil' => $id));
    }
}
?>
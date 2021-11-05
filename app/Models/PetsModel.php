<?php

namespace App\Models;

use CodeIgniter\Model;

class PetsModel extends Model
{
    protected $table = 'pets';
    protected $useTimestamps = true;

    public function getPets($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addPet($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePet($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deletePet($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

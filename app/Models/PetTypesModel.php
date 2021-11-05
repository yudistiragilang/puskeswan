<?php

namespace App\Models;

use CodeIgniter\Model;

class PetTypesModel extends Model
{
    protected $table = 'pet_types';
    protected $useTimestamps = true;

    public function getPetTypes($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addPetType($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePetType($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deletePetType($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

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
            $builder = $this->select('pets.id, pets.pets_name, z.owner_name, pets.gander, x.description AS type, c.breed');
            $builder->join('owners AS z', 'z.nik=pets.pets_owner');
            $builder->join('pet_types AS x', 'x.id=pets.pet_type');
            $builder->join('breeds AS c', 'c.id=pets.breed');
            $builder->where('pets.deleted_at is null', null, false);
            $result = $builder->paginate($pager, $pager_grup);
            return $result;
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

<?php

namespace App\Models;

use CodeIgniter\Model;

class BreedsModel extends Model
{
    protected $table = 'breeds';
    protected $useTimestamps = true;

    public function getBreeds($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addBreed($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateBreed($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteBreed($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

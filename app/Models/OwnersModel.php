<?php

namespace App\Models;

use CodeIgniter\Model;

class OwnersModel extends Model
{
    protected $table = 'owners';
    protected $useTimestamps = true;

    public function getOwners($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addOwner($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateOwner($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteOwner($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

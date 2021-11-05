<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table = 'roles';
    protected $useTimestamps = true;

    public function getRoles($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addRole($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateRole($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteRole($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

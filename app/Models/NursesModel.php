<?php

namespace App\Models;

use CodeIgniter\Model;

class NursesModel extends Model
{
    protected $table = 'nurses';
    protected $useTimestamps = true;

    public function getNurses($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addNurse($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateNurse($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteNurse($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

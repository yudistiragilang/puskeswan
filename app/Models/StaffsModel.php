<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffsModel extends Model
{
    protected $table = 'staffs';
    protected $useTimestamps = true;

    public function getStaffs($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addStaff($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateStaff($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteStaff($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

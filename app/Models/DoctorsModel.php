<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorsModel extends Model
{
    protected $table = 'doctors';
    protected $useTimestamps = true;

    public function getDoctors($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addDoctor($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateDoctor($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteDoctor($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

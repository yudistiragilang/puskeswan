<?php

namespace App\Models;

use CodeIgniter\Model;

class DiseasesModel extends Model
{
    protected $table = 'diseases';
    protected $useTimestamps = true;

    public function getDiseases($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addDisease($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateDisease($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteDisease($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

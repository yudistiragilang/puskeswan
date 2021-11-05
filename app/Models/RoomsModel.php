<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomsModel extends Model
{
    protected $table = 'rooms';
    protected $useTimestamps = true;

    public function getRooms($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addRoom($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateRoom($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteRoom($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

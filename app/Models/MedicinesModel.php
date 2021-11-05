<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicinesModel extends Model
{
    protected $table = 'medicines';
    protected $useTimestamps = true;

    public function getMedicines($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addMedicine($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateMedicine($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteMedicine($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

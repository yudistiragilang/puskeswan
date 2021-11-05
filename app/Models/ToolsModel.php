<?php

namespace App\Models;

use CodeIgniter\Model;

class ToolsModel extends Model
{
    protected $table = 'tools';
    protected $useTimestamps = true;

    public function getTools($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            return $this->where('deleted_at is null', null, false)->paginate($pager, $pager_grup);
        } else {
            return $this->findAll();
        }
    }

    public function addTool($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateTool($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteTool($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

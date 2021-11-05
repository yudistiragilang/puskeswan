<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountsModel extends Model
{
    protected $table = 'accounts AS a';
    protected $useTimestamps = true;

    public function getAccounts($pager = null, $pager_grup = null)
    {
        if ($pager != null) {
            $select = $this->select('a.*, r.role AS nama_role');
            $select->join('roles AS r', 'r.id = a.role');
            $select->where('a.deleted_at is null', null, false);
            $return = $select->paginate($pager, $pager_grup);
            return $return;
        } else {
            return $this->findAll();
        }
    }

    public function addAccount($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateAccount($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteAccount($id, $data)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}

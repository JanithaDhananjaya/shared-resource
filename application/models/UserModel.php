<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function get_user()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function insertUser($data)
    {
        return $this->db->insert('user', $data);
    }

    public function findUser($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('user');
        return $query->row();
    }

    public function updateUser($id, $data)
    {
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }

    public function deleteUser($id)
    {
        return $this->db->delete('user', ['user_id' => $id]);
    }
}

?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostModel extends CI_Model
{
    public function get_post()
    {
        $query = $this->db->get('post');
        return $query->result();
    }

    public function addPost($data)
    {
        return $this->db->insert('post', $data);
    }

    public function findPost($id)
    {
        $this->db->where('post_id', $id);
        $query = $this->db->get('post');
        return $query->row();
    }

    public function updatePost($id, $data)
    {
        $this->db->where('post_id', $id);
        return $this->db->update('post', $data);
    }

    public function deletePost($id)
    {
        return $this->db->delete('post', ['post_id' => $id]);
    }
}

?>
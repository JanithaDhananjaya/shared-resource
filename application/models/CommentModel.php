<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CommentModel extends CI_Model
{
    public function get_comment()
    {
        $query = $this->db->get('comment');
        return $query->result();
    }

    public function insertComment($data)
    {
        return $this->db->insert('comment', $data);
    }

    public function findComment($id)
    {
        $this->db->where('comment_id', $id);
        $query = $this->db->get('comment');
        return $query->row();
    }

    public function updateComment($id, $data)
    {
        $this->db->where('comment_id', $id);
        return $this->db->update('comment', $data);
    }

    public function deleteComment($id)
    {
        return $this->db->delete('comment', ['comment_id' => $id]);
    }
}

?>
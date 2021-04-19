<?php

class Tree_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('tree_node', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('tree_node_id', $id);
        $query = $this->db->get('tree_node');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false, $active = false)
    {
        if ($order)
            $this->db->order_by($order, $by);
        if ($cant)
            $this->db->limit($cant);
        if ($active)
            $this->db->where('is_active', 1);
        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        $query = $this->db->get('tree_node');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('tree_node_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('tree_node');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('tree_node_id', $id);
        $this->db->delete('tree_node');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }
        return $afec;
    }

    function get_node_by_user_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('tree_node');

        return $query->row();
    }

    function get_all_children($user_id)
    {
        $this->db->select('*');
        $this->db->from('tree_node');
        $this->db->join('user', 'user.user_id = tree_node.user_id');
        $this->db->where('tree_node.parent', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_parent_by_user_id($user_id)
    {
        $this->db->select('*');
        $this->db->from('tree_node');
        $this->db->join('user', 'user.user_id = tree_node.parent');
        $this->db->where('tree_node.user', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}

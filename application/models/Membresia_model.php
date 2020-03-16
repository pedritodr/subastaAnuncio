<?php

class Membresia_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('membresia', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_membresia_user($data)
    {
        $this->db->insert('membresia_user', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('membresia_id', $id);
        $query = $this->db->get('membresia');

        return $query->row();
    }

    function get_membresia_by_user_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('membresia_user');

        return $query->row();
    }
    function get_by_user_id($id)
    {
        $this->db->select('*');
        $this->db->from('membresia_user');
        $this->db->join('membresia', 'membresia.membresia_id =membresia_user.membresia_id');
        $this->db->where('membresia_user.user_id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('membresia');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function get_all_membresias_user()
    {
        $this->db->select('*');
        $this->db->from('membresia_user');
        $this->db->join('membresia', 'membresia.membresia_id =membresia_user.membresia_id');
        $this->db->where('membresia_user.estado', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_membresias_users()
    {
        $this->db->select('*');
        $this->db->from('membresia_user');
        $this->db->join('membresia', 'membresia.membresia_id =membresia_user.membresia_id');
        $this->db->join('user', 'user.user_id =membresia_user.user_id');
        $this->db->where('membresia_user.estado', 1);
        $query = $this->db->get();
        return $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('membresia_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('membresia');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function update_membresia_user($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('membresia_user_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('membresia_user');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }



    function delete($id)
    {
        $this->db->where('membresia_id', $id);
        $this->db->delete('membresia');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }










    //------------------------------------------------------------------------------------------------------------------------------------------
}

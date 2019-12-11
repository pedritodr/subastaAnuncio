<?php

class Role_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('role', $data);
        $id = $this->db->insert_id();
        return $id;
    }



    function get_by_id($id)
    {
        $this->db->where('role_id', $id);
        $query = $this->db->get('role');

        return $query->row();
    }

    
    function get_all($conditions = [], $get_as_row = FALSE)
    {
       // $this->db->where('role_id !=', 1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('role');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('role_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('role');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }


    function delete($id)
    {
        $this->db->where('role_id', $id);
        $this->db->delete('role');
        $afec = $this->db->affected_rows();


        return $afec;
    }




    //------------------------------------------------------------------------------------------------------------------------------------------
}

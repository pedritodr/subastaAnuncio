<?php

class Premio_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('premio', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('premio_id', $id);
        $query = $this->db->get('premio');
        return $query->row();
    }



    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('premio');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_date($date)
    {
        $this->db->select('*');
        $this->db->from('premio');
        $this->db->where("fecha_create >=", $date);
        $this->db->where("tipo", 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_date_vip()
    {
        $this->db->select('*');
        $this->db->from('premio');
        //   $this->db->where("fecha_create >=", $date);
        $this->db->where("tipo", 2);
        $query = $this->db->get();
        return $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('premio_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('premio');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('premio_id', $id);
        $this->db->delete('premio');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }



    //------------------------------------------------------------------------------------------------------------------------------------------
}

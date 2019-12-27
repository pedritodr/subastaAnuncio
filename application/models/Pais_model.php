<?php

class Pais_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data) //pais
    {
        $this->db->insert('pais', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_cuidad($data)
    {
        $this->db->insert('ciudad', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id) //pais
    {
        $this->db->where('pais_id', $id);
        $query = $this->db->get('pais');

        return $query->row();
    }

    function get_by_pais_id($id) //pais
    {

        $this->db->where('pais_id', $id);
        $query = $this->db->get('pais');

        return $query->result();
    }

    function get_by_pais_id_object($id)
    {

        $this->db->where('pais_id', $id);
        $query = $this->db->get('ciudad');

        return $query->result(); //retorna un listado

    }



    function get_by_ciudad_id_object($id)
    {

        $this->db->where('ciudad_id', $id);
        $query = $this->db->get('ciudad');

        return $query->row();
    }

    function get_by_city_all($ciudad_id)
    {

        $this->db->select('*');
        $this->db->from('ciudad');
        $this->db->join('pais', 'pais.pais_id = ciudad.pais_id');
        $this->db->where('ciudad_id', $ciudad_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE) //pais
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('pais');

        return ($get_as_row) ? $query->row() : $query->result();
    }


    function get_all_ciudad($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get('ciudad');
        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update_pais($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('pais_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('pais');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }


    function update_ciudad($id, $data)
    {

        $old = $this->get_by_id($id);
        $this->db->where('ciudad_id', $id);
        foreach ($data as $key => $value) {

            $this->db->set($key, $value);
        }

        $this->db->update('ciudad');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {

            $new = $this->get_by_ciudad_id_object($id);
        }

        return $afec;
    }


    function delete_pais($id)
    {
        $this->db->where('pais_id', $id);
        $this->db->delete('pais');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }




    function delete_ciudad($id)
    {
        $this->db->where('ciudad_id', $id);
        $this->db->delete('ciudad');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }








    //------------------------------------------------------------------------------------------------------------------------------------------
}

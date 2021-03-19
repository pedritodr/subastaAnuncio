<?php

class Photo_anuncio_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('photo_anuncio', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }




    function get_by_id($id)
    {
        $this->db->where('photo_anuncio_id', $id);
        $query = $this->db->get('photo_anuncio');

        return $query->row();
    }


    function get_by_anuncio_id($id)
    {
        $this->db->where('anuncio_id', $id);
        $query = $this->db->get('photo_anuncio');

        return $query->result();
    }



    function get_by_anuncio_id_object($id)
    {
        $this->db->where('anuncio_id', $id);
        $query = $this->db->get('photo_anuncio');

        return $query->row();
    }




    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('photo_anuncio');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('photo_anuncio_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('photo_anuncio');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }




    function delete($id)
    {
        $this->db->where('photo_anuncio_id', $id);
        $this->db->delete('photo_anuncio');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function delete_fotos($id)
    {
        $this->db->where('anuncio_id', $id);
        $this->db->delete('photo_anuncio');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }









    //------------------------------------------------------------------------------------------------------------------------------------------
}

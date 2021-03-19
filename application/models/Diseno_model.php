<?php

class Diseno_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('diseno', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_foto_diseno($data)
    {
        $this->db->insert('diseno_foto', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('diseno_id', $id);
        $query = $this->db->get('diseno');

        return $query->row();
    }

    function get_by_diseno_id($id)
    {
        $this->db->where('diseno_id', $id);
        $query = $this->db->get('diseno_foto');

        return $query->result();
    }

    function get_by_productos_id($id)
    {
        $this->db->where('producto_id !=', $id);
        $this->db->where('is_active', 1);
        $query = $this->db->get('producto');

        return $query->result();
    }



    function get_by_foto_diseno_id($id)
    {
        $this->db->where('diseno_id', $id);
        $query = $this->db->get('diseno_foto');

        return $query->result();
    }

    function get_by_foto_diseno_id_object($id)
    {
        $this->db->where('diseno_foto_id', $id);
        $query = $this->db->get('diseno_foto');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        //$this->db->where('is_active',1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('diseno');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('diseno_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('diseno');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function update_foto_diseno($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('diseno_foto_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('diseno_foto');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('diseno_id', $id);
        $this->db->delete('diseno');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function delete_foto_diseno($id)
    {
        $this->db->where('diseno_foto_id', $id);
        $this->db->delete('diseno_foto');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }



    function get_all_products()
    {
        $this->db->select('producto.producto_id,producto.name,producto.stock,producto.descuento,producto.price,producto.description,producto.main_photo,coleccion.name as coleccion, categoria.nombre as categoria,producto.is_active');
        $this->db->from('producto');
        $this->db->join('coleccion', 'coleccion.coleccion_id = producto.coleccion_id');
        $this->db->join('categoria', 'categoria.categoria_id = producto.categoria_id');

        $query = $this->db->get();
        return $query->result();
    }








    //------------------------------------------------------------------------------------------------------------------------------------------
}

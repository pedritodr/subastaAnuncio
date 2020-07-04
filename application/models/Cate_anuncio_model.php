<?php

class Cate_anuncio_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('cate_anuncio', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_sub_cate($data)
    {

        $this->db->insert('sub_categoria', $data);
        $id = $this->db->insert_id();

        return $id;
    }



    function get_by_id($id)
    {
        $this->db->where('cate_anuncio_id', $id);
        $query = $this->db->get('cate_anuncio');

        return $query->row();
    }


    function get_by_subcate_id_object($id)
    {

        $this->db->where('subcate_id', $id);
        $query = $this->db->get('sub_categoria');

        return $query->row();
    }


    function get_by_subcate_id($id)
    {


        $this->db->where('subcate_id', $id);
        $query = $this->db->get('sub_categoria');

        return $query->result();
    }


    function get_by_Cate_anuncio_id($id)
    {

        $this->db->where('cate_anuncio_id', $id);
        $query = $this->db->get('sub_categoria');

        return $query->result();
    }

    function get_by_Cate_subasta_id($id)
    {

        $this->db->where('categoria_id', $id);
        $query = $this->db->get('subcategoria_subasta');

        return $query->result();
    }
    function get_all_categorias($id)
    {
        $this->db->select('sub_categoria.nombre as sub,cate_anuncio.nombre as categoria');
        $this->db->from('cate_anuncio');
        $this->db->join('sub_categoria', 'sub_categoria.cate_anuncio_id=cate_anuncio.cate_anuncio_id');
        $this->db->where('sub_categoria.subcate_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_categoria_by_sub($id)
    {
        $this->db->select('sub_categoria.nombre as sub,cate_anuncio.nombre as categoria, cate_anuncio.cate_anuncio_id');
        $this->db->from('sub_categoria');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id=sub_categoria.cate_anuncio_id');
        $this->db->where('sub_categoria.subcate_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_sub_categoria_by_sub($id)
    {
        $this->db->select('subcategoria_subasta.nombre as sub,subcategoria_subasta.nombre as categoria, categoria.categoria_id');
        $this->db->from('subcategoria_subasta');
        $this->db->join('categoria', 'categoria.categoria_id=subcategoria_subasta.categoria_id');
        $this->db->where('subcategoria_subasta.subcat_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('cate_anuncio');

        return ($get_as_row) ? $query->row() : $query->result();
    }


    function get_all_subcate()
    {


        $query = $this->db->get('sub_categoria');
        return  $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('cate_anuncio_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('cate_anuncio');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }


    function update_subcate($id, $data)
    {

        $old = $this->get_by_id($id);
        $this->db->where('subcate_id', $id);
        foreach ($data as $key => $value) {

            $this->db->set($key, $value);
        }

        $this->db->update('sub_categoria');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {

            $new = $this->get_by_subcate_id_object($id);
        }

        return $afec;
    }



    function delete($id)
    {
        $this->db->where('cate_anuncio_id', $id);
        $this->db->delete('cate_anuncio');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }


    function delete_subcate($id)
    {
        $this->db->where('subcate_id', $id);
        $this->db->delete('sub_categoria');
        $afect = $this->db->affected_rows();

        if ($afect > 0) {
            return $afect;
        }
    }









    //------------------------------------------------------------------------------------------------------------------------------------------
}

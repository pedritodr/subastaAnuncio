<?php

class Anuncio_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('anuncio', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('anuncio_id', $id);
        $query = $this->db->get('anuncio');

        return $query->row();
    }

    function get_by_anuncio_user_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('anuncio');

        return $query->result();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('anuncio');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_anuncios_id($id)
    {

        $this->db->select('cate_anuncio.cate_anuncio_id,user.photo as photo_perfil,user.email,user.phone,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.anuncio_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    function get_all_fotos($conditions = [], $get_as_row = FALSE)
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
        $this->db->where('anuncio_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('anuncio');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }




    function delete($id)
    {
        $this->db->where('anuncio_id', $id);
        $this->db->delete('anuncio');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }


    function get_all_by_anuncios_with_pagination($id, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('anuncio');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncio_palabra($name)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->like('anuncio.titulo', $name);

        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncios()
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncios_by_category($id)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_relacionados($id, $anuncio)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.anuncio_id', $anuncio);
        $this->db->where('anuncio.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncios_by_subcategory($id)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.subcate_id', $id);
        $this->db->where('anuncio.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }


    function get_all_anuncios_with_pagination($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->order_by('anuncio.anuncio_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_categoria($limit, $start, $id)
    {

        $this->db->limit($limit, $start);
        $this->db->select('user.photo as photo_perfil,anuncio.fecha,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_category($limit, $start, $id)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.is_active', 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_name($limit, $start, $palabra)
    {
        $this->db->select('anuncio.fecha,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->like('anuncio.titulo', $palabra);
        $this->db->where('anuncio.is_active', 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }


    function search_by_name($name)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->like('anuncio.titulo', $name);
        $query = $this->db->get();
        return $query->result();


        /* $query = "SELECT * FROM anuncio  WHERE is_active = 1  AND titulo LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();*/
    }

    function anuncio_by_id($id)
    {
        $this->db->select('anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->like('anuncio.anuncio_id', $id);
        $query = $this->db->get();
        return $query->row();


        /* $query = "SELECT * FROM anuncio  WHERE is_active = 1  AND titulo LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();*/
    }



    //------------------------------------------------------------------------------------------------------------------------------------------
}

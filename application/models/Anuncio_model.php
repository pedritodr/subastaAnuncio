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
        $this->db->order_by('anuncio_id', 'desc');
        $query = $this->db->get('anuncio');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_anuncios_id($id)
    {

        $this->db->select('anuncio.views,anuncio.url,anuncio.destacado,cate_anuncio.cate_anuncio_id,user.photo as photo_perfil,user.email,user.phone,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id', 'left');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id', 'left');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id', 'left');
        $this->db->join('user', 'user.user_id = anuncio.user_id', 'left');
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

    function update_payment($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('payment_id', $id);
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
        $this->db->where('is_delete', 0);
        $this->db->order_by('anuncio_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncio_palabra($name, $ciudad_id, $category)
    {
        $this->db->select('anuncio.destacado,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);

        if ($ciudad_id > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad_id);
        }
        if ($name != "") {
            $this->db->like('anuncio.titulo', $name);
        }
        if ($category > 0) {

            $this->db->where('anuncio.subcate_id', $category);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function get_anuncio_city($ciudad_id)
    {
        $this->db->select('anuncio.url,anuncio.destacado,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        if ($ciudad_id > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad_id);
        }


        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncios()
    {
        $this->db->select('anuncio.url,anuncio.direccion,anuncio.user_id,anuncio.destacado,anuncio.is_active,anuncio.fecha,anuncio.fecha_vencimiento,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        //  $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.anuncio_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncios_by_category($id)
    {
        $this->db->select('anuncio.url,anuncio.destacado,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.is_active', 1);
        //   $this->db->order_by('cate_anuncio.orden', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_anuncios_by_category2($id)
    {
        $this->db->select('anuncio.url,anuncio.destacado,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.subcate_id, sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
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

    function get_anuncios_by_category_city($id, $ciudad_id)
    {
        $this->db->select('anuncio.url,anuncio.destacado,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        if ($ciudad_id > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad_id);
        }
        $this->db->where('anuncio.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_relacionados($id, $anuncio)
    {
        $this->db->select('anuncio.url,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.anuncio_id!=', $anuncio);
        $this->db->where('anuncio.is_active', 1);
        $this->db->limit(5, 0);
        $query = $this->db->get();
        return $query->result();
    }
    function get_anuncios_by_subcategory($id)
    {
        $this->db->select('anuncio.url,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
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

        $this->db->select('anuncio.url,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion, anuncio.subcate_id, anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.fecha', 'desc');

        $this->db->limit($limit, $start);

        $query = $this->db->get();

        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_user($limit, $start, $user_id)
    {

        $this->db->select('anuncio.url,cate_anuncio.cate_anuncio_id,anuncio.subcate_id,anuncio.is_active,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_delete', 0);
        $this->db->where('anuncio.user_id', $user_id);
        $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.fecha', 'desc');

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_recientes()
    {

        $this->db->select('anuncio.url,cate_anuncio.cate_anuncio_id,anuncio.subcate_id,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        $this->db->order_by('anuncio.anuncio_id', 'desc');
        $this->db->limit(5, 0);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_destacados()
    {

        $this->db->select('anuncio.url,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.destacado', 1);
        $this->db->where('anuncio.is_delete', 0);
        $this->db->order_by('anuncio.anuncio_id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_categoria($limit, $start, $id, $ciudad_id)
    {

        $this->db->select('anuncio.url,anuncio.direccion,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        if ($ciudad_id > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad_id);
        }
        $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.anuncio_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_category($limit, $start, $id)
    {
        $this->db->select('anuncio.url,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('cate_anuncio.cate_anuncio_id', $id);
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_anuncios_with_pagination_by_name($limit, $start, $palabra, $ciudad_id, $category = 0)
    {

        $this->db->select('anuncio.url,anuncio.direccion,anuncio.destacado,anuncio.fecha,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio, anuncio.subcate_id, anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        if ($palabra != "") {
            $this->db->like('anuncio.titulo', $palabra);
        }
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        if ($ciudad_id > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad_id);
        }
        if ($category > 0) {
            $this->db->where('anuncio.subcate_id', $category);
        }
        $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.anuncio_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_sub_from_category($limit, $start, $palabra, $ciudad_id, $category = 0)
    {
        $this->db->select('*');
        $this->db->from('sub_categoria');
        $this->db->where('cate_anuncio_id', $category);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_anuncios_with_pagination_by_city($limit, $start, $ciudad_id, $category)
    {
        $this->db->select('anuncio.url,anuncio.direccion,anuncio.destacado,anuncio.fecha,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_delete', 0);
        $this->db->where('anuncio.is_active', 1);
        if ($ciudad_id > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad_id);
        }
        if ($category > 0) {
            $this->db->where('cate_anuncio.cate_anuncio_id', $category);
        }
        $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.anuncio_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function search_by_name2($name)
    {
        $this->db->select('anuncio.url,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        $this->db->like('anuncio.titulo', $name);
        $query = $this->db->get();
        return $query->result();


        /* $query = "SELECT * FROM anuncio  WHERE is_active = 1  AND titulo LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();*/
    }
    function search_by_name_pagination($limit, $start, $name, $ciudad, $categoria, $subcategoria)
    {

        $this->db->limit($limit, $start);
        $this->db->select('anuncio.url,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion, anuncio.subcate_id, anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        if ($name != "") {
            $this->db->like('anuncio.titulo', $name);
        }
        if ($ciudad > 0) {
            $this->db->where('anuncio.ciudad_id', $ciudad);
        }
        if ($categoria > 0 && $subcategoria == 0) {
            $this->db->where('cate_anuncio.cate_anuncio_id', $categoria);
        }
        if ($subcategoria > 0) {
            $this->db->where('anuncio.subcate_id', $subcategoria);
        }
        $this->db->order_by('anuncio.destacado', 'desc');
        $this->db->order_by('anuncio.anuncio_id', 'desc');

        $query = $this->db->get();

        return $query->result();
    }
    function anuncio_by_id($id)
    {
        $this->db->select('anuncio.url,anuncio.destacado,anuncio.user_id,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion,anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->from('anuncio');
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id');
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id');
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id');
        $this->db->join('user', 'user.user_id = anuncio.user_id');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        $this->db->like('anuncio.anuncio_id', $id);
        $query = $this->db->get();
        return $query->row();


        /* $query = "SELECT * FROM anuncio  WHERE is_active = 1  AND titulo LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();*/
    }

    public function searchFull($criteria = null, $ciudad = null, $sub_categoria = null, $categoria = null, $limit = null, $offset = null)
    {
        $porciones = explode(" ", $criteria);

        //var_dump($tienda);exit();
        if ($limit > 0)
            $this->db->limit($limit);

        if ($offset > 0)
            $this->db->offset($offset);

        $cadena[] = $criteria;
        for ($i = 0; $i < count($porciones); $i++) {
            for ($j = 1; $j < count($porciones); $j++) {
                $porcion = $porciones[$i] . " " . $porciones[$j];
                if (!in_array($porcion, $cadena))
                    $cadena[] = $porcion;
            }
        }

        for ($i = 0; $i < count($porciones); $i++) {
            $cadena[] = $porciones[$i];
        }

        $criterias = $cadena;
        /*  var_dump($criterias);
        die(); */
        $result = [];
        //$where_like = false;
        $or = false;
        $where_like = '';
        if ($criteria != null) {
            foreach ($criterias as $criteria) {

                $this->db->distinct();
                $this->db->select('anuncio.views,anuncio.url,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion, anuncio.subcate_id, anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
                $this->db->where('anuncio.is_active', 1);
                $this->db->where('anuncio.is_delete', 0);
                //sub-categoria
                $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id', 'left');
                //categoria
                $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id', 'left');
                //ciudad
                $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id', 'left');
                //user
                $this->db->join('user', 'user.user_id = anuncio.user_id', 'left');
                $this->db->order_by('anuncio.destacado', 'desc');
                $this->db->order_by('anuncio.fecha', 'desc');
                $this->db->from('anuncio');

                if ($sub_categoria > 0)
                    $this->db->where('sub_categoria.subcate_id', $sub_categoria);
                if ($ciudad > 0)
                    $this->db->where('anuncio.ciudad_id', $ciudad);
                if ($categoria > 0)
                    $this->db->where('cate_anuncio.cate_anuncio_id', $categoria);



                $where_like = "( anuncio.titulo LIKE '%" . $criteria . "%'"
                    . " OR anuncio.descripcion LIKE '%" . $criteria . "%'"
                    . " OR cate_anuncio.nombre LIKE '%" . $criteria . "%'"
                    . " OR sub_categoria.nombre LIKE '%" . $criteria . "%'";;
                $where_like .= " )";


                if (strlen($where_like) > 0)
                    $this->db->where($where_like);

                $query = $this->db->get();
                $result = $query->result();
            }
        } else {
            $this->db->distinct();
            $this->db->select('anuncio.views,anuncio.url,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion, anuncio.subcate_id, anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
            $this->db->where('anuncio.is_active', 1);
            $this->db->where('anuncio.is_delete', 0);
            //sub-categoria
            $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id', 'left');
            //categoria
            $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id', 'left');
            //ciudad
            $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id', 'left');
            //user
            $this->db->join('user', 'user.user_id = anuncio.user_id', 'left');
            $this->db->order_by('anuncio.destacado', 'desc');
            $this->db->order_by('anuncio.fecha', 'desc');
            $this->db->from('anuncio');

            if ($sub_categoria > 0)
                $this->db->where('sub_categoria.subcate_id', $sub_categoria);
            if ($ciudad > 0)
                $this->db->where('anuncio.ciudad_id', $ciudad);
            if ($categoria > 0)
                $this->db->where('cate_anuncio.cate_anuncio_id', $categoria);

            $query = $this->db->get();
            $result = $query->result();
        }


        return $result;
    }
    public function fullAds($destacado = null, $ciudad = null, $sub_categoria = null, $categoria = null, $limit = null, $offset = null)
    {
        if ($limit > 0)
            $this->db->limit($limit);

        if ($offset > 0)
            $this->db->offset($offset);

        $this->db->distinct();
        $this->db->select('anuncio.views,anuncio.url,anuncio.destacado,user.photo as photo_perfil,anuncio.fecha,anuncio.direccion,anuncio.anuncio_id,anuncio.titulo,anuncio.descripcion, anuncio.subcate_id, anuncio.precio,anuncio.photo as anuncio_photo,anuncio.whatsapp,anuncio.lat,anuncio.lng,user.name as user,user.photo,sub_categoria.nombre as subcategoria,cate_anuncio.nombre as categoria,cate_anuncio.photo as cate_photo,ciudad.name_ciudad as ciudad');
        $this->db->where('anuncio.is_active', 1);
        $this->db->where('anuncio.is_delete', 0);
        //sub-categoria
        $this->db->join('sub_categoria', 'sub_categoria.subcate_id = anuncio.subcate_id', 'left');
        //categoria
        $this->db->join('cate_anuncio', 'cate_anuncio.cate_anuncio_id = sub_categoria.cate_anuncio_id', 'left');
        //ciudad
        $this->db->join('ciudad', 'ciudad.ciudad_id = anuncio.ciudad_id', 'left');
        //user
        $this->db->join('user', 'user.user_id = anuncio.user_id', 'left');
        if ($destacado == 1)
            $this->db->order_by('anuncio.destacado', 'desc');

        $this->db->order_by('anuncio.fecha', 'desc');
        $this->db->from('anuncio');

        if ($sub_categoria > 0)
            $this->db->where('sub_categoria.subcate_id', $sub_categoria);
        if ($ciudad > 0)
            $this->db->where('anuncio.ciudad_id', $ciudad);
        if ($categoria > 0)
            $this->db->where('cate_anuncio.cate_anuncio_id', $categoria);

        if ($destacado > 0)
            $this->db->where('anuncio.destacado', $destacado);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}

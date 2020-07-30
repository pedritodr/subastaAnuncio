<?php

class Subasta_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('subasta', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_intervalo($data)
    {
        $this->db->insert('intervalo_subasta', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_foto($data)
    {
        $this->db->insert('photo_subasta', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('subasta_id', $id);
        $query = $this->db->get('subasta');

        return $query->row();
    }
    function get_by_intervalo_id_row($id)
    {
        $this->db->where('intervalo_subasta_id', $id);
        $query = $this->db->get('intervalo_subasta');

        return $query->row();
    }

    function get_intevalo_by_id($id)
    {
        $this->db->where('subasta_id', $id);
        $query = $this->db->get('intervalo_subasta');

        return $query->result();
    }

    function get_by_foto_id($id)
    {

        $this->db->where('photo_id', $id);
        $query = $this->db->get('photo_subasta');

        return $query->result();
    }

    function get_by_subasta_id($id)
    {

        $this->db->where('subasta_id', $id);
        $query = $this->db->get('photo_subasta');

        return $query->result(); //retorna un listado

    }

    function get_by_categoria_id($id)
    {
        $this->db->select('subasta.subasta_id,subasta.photo as photo_subasta, ciudad.name_ciudad,subasta.nombre_espa, subasta.valor_inicial, subasta.fecha_cierre, subasta.descrip_espa,subasta.tipo_subasta,subasta.valor_maximo,subasta.valor_minimo,subasta.porcentaje,subasta.cantidad_dias,subasta.intervalo,subasta.qty_articles');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->where('categoria.categoria_id', $id);
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.is_open', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_intervalo_subasta($id) //foto subasta
    {

        $this->db->where('subasta_id', $id);
        $query = $this->db->get('intervalo_subasta');

        return $query->result();
    }

    function get_by_foto_id_object($id) //foto subasta
    {

        $this->db->where('photo_id', $id);
        $query = $this->db->get('photo_subasta');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get('subasta');

        return ($get_as_row) ? $query->row() : $query->result();
    }


    function get_all_fotos($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }

        $query = $this->db->get('photo_subasta');
        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('subasta_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('subasta');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function update_subasta_user($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('payment_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('subasta_user');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function update_intervalo($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('intervalo_subasta_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('intervalo_subasta');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }


    function update_fotos($id, $data)
    {

        $old = $this->get_by_id($id);
        $this->db->where('photo_id', $id);
        foreach ($data as $key => $value) {

            $this->db->set($key, $value);
        }

        $this->db->update('photo_subasta');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {

            $new = $this->get_by_foto_id_object($id);
        }

        return $afec;
    }


    function delete($id)
    {
        $this->db->where('subasta_id', $id);
        $this->db->delete('subasta');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function delete_subasta_user($id)
    {
        $this->db->where('subasta_id', $id);
        $this->db->delete('subasta');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }


    function delete_foto($id)
    {
        $this->db->where('photo_id', $id);
        $this->db->delete('photo_subasta');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function get_subastas()
    {
        $this->db->select('subasta.is_open,subasta.tipo_subasta,subasta.valor_maximo,subasta.valor_minimo,subasta.porcentaje,subasta.cantidad_dias,subasta.intervalo,subasta.qty_articles,subasta.subasta_id,subasta.photo as subasta_photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.fecha_cierre,subasta.valor_pago,user.name as user,user.photo,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta.user_id');
        $this->db->where('subasta.is_active', 1);

        $query = $this->db->get();
        return $query->result();
    }
    function get_subastas_directas()
    {
        $this->db->select('subasta.is_open,subasta.tipo_subasta,subasta.valor_maximo,subasta.valor_minimo,subasta.porcentaje,subasta.cantidad_dias,subasta.intervalo,subasta.qty_articles,subasta.subasta_id,subasta.photo as subasta_photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.fecha_cierre,subasta.valor_pago,user.name as user,user.photo,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta.user_id');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.tipo_subasta', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_subastas_directas_by_user($user_id)
    {
        $this->db->select('subasta.is_open,subasta.tipo_subasta,subasta.subasta_id,subasta.photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.valor_pago,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad,ciudad.ciudad_id,categoria.categoria_id');
        $this->db->from('subasta');
        $this->db->join('subasta_user', 'subasta_user.subasta_id = subasta.subasta_id');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.tipo_subasta', 1);
        $this->db->where('subasta_user.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_subastas_inversas_by_user($user_id)
    {
        $this->db->select('intervalo_subasta.valor as costo,subasta.tipo_subasta,subasta.subasta_id,subasta.photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.valor_pago,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad,ciudad.ciudad_id,categoria.categoria_id');
        $this->db->from('subasta');
        $this->db->join('subasta_user', 'subasta_user.subasta_id = subasta.subasta_id');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->join('intervalo_subasta', 'intervalo_subasta.intervalo_subasta_id = subasta_user.intervalo_subasta_id');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.tipo_subasta', 2);
        $this->db->where('subasta_user.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_subastas_inversas()
    {
        $this->db->select('subasta.tipo_subasta,subasta.valor_maximo,subasta.valor_minimo,subasta.porcentaje,subasta.cantidad_dias,subasta.intervalo,subasta.qty_articles,subasta.subasta_id,subasta.photo as subasta_photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.fecha_cierre,subasta.valor_pago,user.name as user,user.photo,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta.user_id');
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.tipo_subasta', 2);

        $query = $this->db->get();
        return $query->result();
    }
    function get_subastas_category($id, $tipo)
    {
        $this->db->select('subasta.subasta_id,subasta.photo as subasta_photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.fecha_cierre,subasta.valor_pago,user.name as user,user.photo,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta.user_id');
        $this->db->where('subasta.tipo_subasta', $tipo);
        $this->db->where('categoria.categoria_id', $id);
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_search_all($id, $name, $tipo, $ciudad_id)
    {
        $this->db->select('subasta.subasta_id,subasta.photo as subasta_photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.fecha_cierre,subasta.valor_pago,user.name as user,user.photo,ciudad.name_ciudad as ciudad');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('subcategoria_subasta', 'subcategoria_subasta.subcat_id = subasta.subcat_id');
        $this->db->join('user', 'user.user_id = subasta.user_id');

        if ($id > 0) {
            $this->db->where('subcategoria_subasta.subcat_id', $id); //modificado por jose, campo anterior categoria_id
        }
        if ($name != NULL) {
            $this->db->like('subasta.nombre_espa', $name);
        }
        if ($ciudad_id > 0) {
            $this->db->where('subasta.ciudad_id', $ciudad_id);
        }
        $this->db->where('subasta.tipo_subasta', $tipo);
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);

        $query = $this->db->get();
        return $query->result();
    }
    function get_subastas_palabra($name, $tipo)
    {
        $this->db->select('subasta.subasta_id,subasta.photo as subasta_photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.fecha_cierre,subasta.valor_pago,user.name as user,user.photo,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta.user_id');
        $this->db->where('subasta.tipo_subasta', $tipo);
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);
        $this->db->like('subasta.nombre_espa', $name);

        $query = $this->db->get();
        return $query->result();
    }

    function get_all_by_subastas_with_pagination($limit, $start, $tipo)
    {
        $this->db->limit($limit, $start);
        $this->db->select('subasta.tipo_subasta, subasta.categoria_id, subasta.subcat_id, subasta.subasta_id,subasta.photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.valor_pago,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad,ciudad.ciudad_id,categoria.categoria_id');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        // $this->db->join('user', 'user.user_id = subasta.user_id');
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.tipo_subasta', $tipo);
        // $this->db->order_by('subasta.fecha_cierre', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_by_subastas_with_pagination_categoria($limit, $start, $id, $tipo)
    {
        $this->db->limit($limit, $start);
        $this->db->select('subasta.tipo_subasta,subasta.subasta_id,subasta.photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.valor_pago,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad,ciudad.ciudad_id,categoria.categoria_id');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.tipo_subasta', $tipo);
        $this->db->where('categoria.categoria_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_by_subastas_with_pagination_search($limit, $start, $id, $palabra, $tipo, $ciudad_id)
    {
        $this->db->limit($limit, $start);
        $this->db->select('subasta.tipo_subasta,subasta.categoria_id, subasta.subcat_id, subasta.subasta_id,subasta.photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.valor_pago, subcategoria_subasta.nombre as categoria, ciudad.name_ciudad as ciudad,ciudad.ciudad_id, subcategoria_subasta.subcat_id');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('subcategoria_subasta', 'subcategoria_subasta.subcat_id = subasta.subcat_id');
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);

        if ($id > 0) {
            $this->db->where('subasta.subcat_id', $id); //Campo anterior, categoria_id
        }
        if ($ciudad_id > 0) {
            $this->db->where('subasta.ciudad_id', $ciudad_id);
        }
        if ($palabra != "") {
            $this->db->like('subasta.nombre_espa', $palabra);
        }
        $this->db->where('subasta.tipo_subasta', $tipo);


        $query = $this->db->get();

        return $query->result();
    }
    function get_all_by_subastas_with_pagination_palabra($limit, $start, $palabra, $tipo)
    {
        $this->db->limit($limit, $start);
        $this->db->select('subasta.tipo_subasta,subasta.subasta_id,subasta.photo,subasta.nombre_espa,subasta.descrip_espa,subasta.valor_inicial,subasta.fecha_cierre,subasta.valor_pago,categoria.name_espa as categoria,ciudad.name_ciudad as ciudad,ciudad.ciudad_id,categoria.categoria_id');
        $this->db->from('subasta');
        $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.tipo_subasta', $tipo);
        $this->db->like('subasta.nombre_espa', $palabra);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_by_subastas_with_pagination2($limit, $start, $fecha, $tipo)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('subasta');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.tipo_subasta', $tipo);
        $this->db->where("subasta.fecha_cierre >=", $fecha);
        // $this->db->order_by('subasta.fecha_cierre', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_by_mis_subastas_with_pagination($limit, $start, $user_id)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('subasta');
        $this->db->join('subasta_user', 'subasta_user.subasta_id = subasta.subasta_id');
        /*      $this->db->join('ciudad', 'ciudad.ciudad_id = subasta.ciudad_id');
        $this->db->join('categoria', 'categoria.categoria_id = subasta.categoria_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id'); */
        $this->db->where('subasta_user.user_id', $user_id);
        $this->db->where('subasta_user.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_by_subastas_rest()
    {
        $this->db->select('*');
        $this->db->from('subasta');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.is_open', 1);
        $this->db->where('subasta.tipo_subasta', 1);
        // $this->db->order_by('subasta.fecha_cierre', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_by_subastas_with_pagination3($limit, $start, $id)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('subasta');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.categoria_id', $id);
        // $this->db->order_by('subasta.fecha_cierre', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_subasta_user($user_id, $subasta_id)
    {
        $this->db->select('*');
        $this->db->from('subasta_user');
        $this->db->where('user_id', $user_id);
        $this->db->where('subasta_id', $subasta_id);
        $this->db->where('is_active', 1);
        $this->db->where('intervalo_subasta_id', NULL);
        $query = $this->db->get();
        return $query->row();
    }
    /*  function get_pujas_user($user_id, $subasta_id)
    {
        $this->db->select('*');
        $this->db->from('subasta_user');
        $this->db->join('subasta', 'subasta.subasta_id = subasta_user.subasta_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->where('subasta_user.user_id', $user_id);
        $this->db->where('subasta_user.subasta_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }*/
    function create_subasta_user($data)
    {
        $this->db->insert('subasta_user', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_puja($data)
    {
        $this->db->insert('puja', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_puja_alta($subasta_id = 0)
    {

        $this->db->select_max('puja.valor');
        $this->db->from('puja');
        $this->db->join('subasta_user', 'subasta_user.subasta_user_id = puja.subasta_user_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->where('subasta_user.subasta_id', $subasta_id);
        $this->db->where('subasta_user.is_active', 1);
        $query = $this->db->get();
        return $query->row();
    }
    function get_puja_alta_obj($subasta_id = 0)
    {

        $this->db->select('*');
        $this->db->from('puja');
        $this->db->join('subasta_user', 'subasta_user.subasta_user_id = puja.subasta_user_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->where('subasta_user.subasta_id', $subasta_id);
        $this->db->where('subasta_user.is_active', 1);
        $this->db->order_by('puja.valor', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    function get_pujas($subasta_id = 0)
    {

        $this->db->select('*');
        $this->db->from('puja');
        $this->db->join('subasta_user', 'subasta_user.subasta_user_id = puja.subasta_user_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->where('subasta_user.subasta_id', $subasta_id);
        $this->db->where('subasta_user.is_active', 1);
        $this->db->order_by('puja.valor', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_user_puja_alta($monto)
    {
        $this->db->select('*');
        $this->db->from('puja');
        $this->db->join('subasta_user', 'subasta_user.subasta_user_id = puja.subasta_user_id');
        $this->db->join('user', 'user.user_id = subasta_user.user_id');
        $this->db->where('puja.valor =', $monto);
        $this->db->where('subasta_user.is_active', 1);
        $query = $this->db->get();
        return $query->row();
    }
    function get_user_puja_alta_2($monto)
    {
        $this->db->select('*');
        $this->db->from('puja');
        $this->db->where('puja.valor =', $monto);
        $query = $this->db->get();
        return $query->row();
    }

    function get_puja_alta_user($subasta_id = 0, $user_id = 0)
    {
        $this->db->select_max('puja.valor');
        $this->db->from('puja');
        $this->db->join('subasta_user', 'subasta_user.subasta_user_id = puja.subasta_user_id');
        $this->db->where('subasta_user.subasta_id', $subasta_id);
        $this->db->where('subasta_user.user_id', $user_id);
        $this->db->where('subasta_user.is_active', 1);
        $query = $this->db->get();
        return $query->row();
    }

    /* function search_by_name($name)
    {
        $query = "SELECT * FROM subasta  WHERE is_active = 1  AND nombre_espa LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();
    } */
    function search_by_name($limit, $start, $name, $tipo, $ciudad, $categoria, $subcategoria)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('subasta');
        $this->db->where('subasta.is_active', 1);
        $this->db->where('subasta.is_open', 1);
        if ($name != "") {
            $this->db->like("subasta.nombre_espa", $name);
        }
        if ($ciudad > 0) {
            $this->db->where('subasta.ciudad_id', $ciudad);
        }
        if ($tipo > 0) {
            $this->db->where('subasta.tipo_subasta', $tipo);
        }
        if ($categoria > 0 && $subcategoria == 0) {
            $this->db->where('subasta.categoria_id', $categoria);
        }
        if ($subcategoria > 0) {
            $this->db->where('subasta.subcat_id', $subcategoria);
        }
        $query = $this->db->get();
        return $query->result();
    }


    function get_by_subasta_user($id) //foto subasta
    {

        $this->db->where('subasta_user_id', $id);
        $query = $this->db->get('subasta_user');

        return $query->row();
    }
    function get_all_subasta_id($id = 0) //foto subasta
    {

        $this->db->where('subasta_id', $id);
        $query = $this->db->get('subasta_user');

        return $query->result();
    }
    function get_by_intervalo_subasta_id($id = 0) //foto subasta
    {

        $this->db->where('intervalo_subasta_id', $id);
        $query = $this->db->get('subasta_user');

        return $query->row();
    }
    function get_all_subasta_intervalo($id = 0) //foto subasta
    {

        $this->db->where('intervalo_subasta_id', $id);
        $query = $this->db->get('subasta_user');

        return $query->result();
    }
    function get_by_puja_id($id) //foto subasta
    {

        $this->db->where('puja_id', $id);
        $query = $this->db->get('puja');

        return $query->row();
    }
    function get_puja_by_max($valor)
    {

        $this->db->where('valor', $valor);
        $query = $this->db->get('puja');

        return $query->row();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}

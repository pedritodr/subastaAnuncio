<?php

class Favorito_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('favorito', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('favorito_id', $id);
        $query = $this->db->get('favorito');

        return $query->row();
    }
    function get_by_user_id_coleccion($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('favorito');

        $all_favoritos = $query->result();

        if ($all_favoritos) {
            $all_favoritos_ids = [];
            foreach ($all_favoritos as $item) {

                array_push($all_favoritos_ids, $item->coleccion_id);
            }
            return $all_favoritos_ids;
        } else return null;
    }

    function get_by_user_id_producto($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('favorito');

        $all_favoritos = $query->result();

        if ($all_favoritos) {
            $all_favoritos_ids = [];
            foreach ($all_favoritos as $item) {

                array_push($all_favoritos_ids, $item->producto_id);
            }
            return $all_favoritos_ids;
        } else return null;
    }

    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false, $active = false)
    {
        if ($order)
            $this->db->order_by($order, $by);
        if ($cant)
            $this->db->limit($cant);
        if ($active)
            $this->db->where('is_active', 1);
        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        $query = $this->db->get('favorito');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('favorito_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('favorito');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('favorito_id', $id);
        $this->db->delete('favorito');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function delete_coleccion($user_id, $coleccion_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('coleccion_id', $coleccion_id);
        $this->db->delete('favorito');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function delete_producto($user_id, $producto_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('producto_id', $producto_id);
        $this->db->delete('favorito');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function get_all_colecciones($user_id)
    {
        $this->db->select('coleccion.name,coleccion.main_photo,coleccion.coleccion_id');
        $this->db->from('favorito');
        $this->db->join('user', 'user.user_id = favorito.user_id');
        $this->db->join('coleccion', 'coleccion.coleccion_id = favorito.coleccion_id');
        $this->db->where('favorito.user_id', $user_id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_productos($user_id)
    {
        $this->db->select('producto.name,producto.price,producto.main_photo,producto.producto_id,producto.descuento,producto.stock');
        $this->db->from('favorito');
        $this->db->join('user', 'user.user_id = favorito.user_id');
        $this->db->join('producto', 'producto.producto_id = favorito.producto_id');
        $this->db->where('favorito.user_id', $user_id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_clientes_by_destinations($id)
    {
        $this->db->select('dialing.dialing_id,cliente.cliente_id,dialing.name,destination.name as name_destination,country.name as name_country');
        $this->db->from('cliente');
        $this->db->join('user', 'user.user_id = cliente.user_id');
        $this->db->join('dialing', 'dialing.cliente_id = cliente.cliente_id');
        $this->db->join('destination', 'destination.destination_id = dialing.destination_id');
        $this->db->join('country', 'country.country_id = cliente.country_id');
        $this->db->where('dialing.cliente_id', $id);


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_favorito_coleccion_like($coleccion_id)
    {
        $this->db->select('count(*) as count');
        $this->db->from('favorito');
        $this->db->where('favorito.coleccion_id', $coleccion_id);

        $query = $this->db->get();

        return $query->row();
    }

    function get_all_favorito_producto_like($producto_id)
    {
        $this->db->select('count(*) as count');
        $this->db->from('favorito');
        $this->db->where('favorito.producto_id', $producto_id);

        $query = $this->db->get();

        return $query->row();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}

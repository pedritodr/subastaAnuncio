<?php

class Product_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('producto', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_foto_producto($data)
    {
        $this->db->insert('foto_producto', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_producto_by_coleccion_id($id)
    {
        $this->db->where('coleccion_id', $id);
        $this->db->where('is_active', 1);
        $query = $this->db->get('producto');
        return $query->result();
    }

    function get_producto_by_categoria_id($id)
    {
        $this->db->where('categoria_id', $id);
        $this->db->where('is_active', 1);
        $query = $this->db->get('producto');
        return $query->result();
    }

    function get_by_id($id)
    {
        $this->db->where('producto_id', $id);
        $query = $this->db->get('producto');

        return $query->row();
    }

    function get_by_producto_id($id)
    {
        $this->db->where('producto_id', $id);
        $query = $this->db->get('foto_producto');

        return $query->result();
    }

    function get_by_productos_id($id)
    {
        $this->db->where('producto_id !=', $id);
        $this->db->where('is_active', 1);
        $query = $this->db->get('producto');

        return $query->result();
    }

    function get_relacionado_by_id($id)
    {
        $this->db->where('relacionado_producto_id', $id);
        $query = $this->db->get('relacionado_producto');

        return $query->result();
    }

    function get_by_foto_producto_id($id)
    {
        $this->db->where('foto_producto_id', $id);
        $query = $this->db->get('foto_producto');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        //$this->db->where('is_active',1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('producto');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('producto_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('producto');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function update_foto_coleccion($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('foto_producto_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('foto_producto');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('producto_id', $id);
        $this->db->delete('producto');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function delete_foto_producto($id)
    {
        $this->db->where('foto_producto_id', $id);
        $this->db->delete('foto_producto');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function delete_relacionado($id)
    {
        $this->db->where('relacionado_producto_id', $id);
        $this->db->delete('relacionado_producto');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    public function activelog($id, $field, $action, $new = null, $old = null)
    {
        $model = 'banner';
        $this->load->model('Activelog_model', 'activelog');
        $log = new Activelog_model();
        $log->model = $model;
        $log->idModel = $id;
        $log->field = $field;
        if ($action == 1)
            $log->afterSave($log);
        else if ($action == 2)
            $log->afterUpdate($log, $new, $old);
        else if ($action == 3)
            $log->afterDelete($log);
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
    function get_all_products_group_coleccion()
    {
        $this->db->select('producto.producto_id,producto.name,producto.stock,producto.descuento,producto.price,producto.description,producto.main_photo,coleccion.name as coleccion, categoria.nombre as categoria,producto.is_active');
        $this->db->from('producto');
        $this->db->join('coleccion', 'coleccion.coleccion_id = producto.coleccion_id');
        $this->db->join('categoria', 'categoria.categoria_id = producto.categoria_id');
        $this->db->group_by('producto.coleccion_id');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_products_relacionados($producto_id)
    {
        $this->db->select('producto.producto_id,producto.name,producto.price,producto.description,producto.main_photo,producto.descuento,producto.stock');
        $this->db->from('relacionado_producto');
        $this->db->join('producto', 'producto.producto_id = relacionado_producto.producto_relacionado_id');
        $this->db->where('relacionado_producto.producto_id', $producto_id);
        //    $this->db->where('producto.producto_id !=', $producto_id);

        $query = $this->db->get();
        return $query->result();
    }
    function search_by_name($name)
    {
        $query = "SELECT * FROM producto WHERE name LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
    function order_price_product($order)
    {
        $query = "SELECT * FROM producto order by price $order";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
    function order_name_product($order)
    {
        $query = "SELECT * FROM producto order by name $order";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }

    function get_all_relacionado_by_producto($id)
    {

        $this->db->select('producto.producto_id, producto.name,producto.main_photo,relacionado_producto.relacionado_producto_id');
        $this->db->from('relacionado_producto');
        $this->db->join('producto', 'producto.producto_id = relacionado_producto.producto_relacionado_id');
        $this->db->where('relacionado_producto.producto_id', $id);
        // $this->db->where('producto.is_active', 0);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_products_by_product_id_simple($id)
    {
        $this->db->select('producto_relacionado_id');
        $this->db->where('producto_id', $id);
        $query = $this->db->get('relacionado_producto');


        $all_products = $query->result();

        if ($all_products) {
            $all_products_ids = [];
            foreach ($all_products as $item) {

                array_push($all_products_ids, $item->producto_relacionado_id);
            }
            return $all_products_ids;
        } else return null;
    }
    function create_relacionado_products_array($id, $array)
    {

        $this->db->where('producto_id', $id);
        $this->db->delete('relacionado_producto');

        foreach ($array as $item) {
            $data = ['producto_id' => $id, 'producto_relacionado_id' => $item];
            $this->db->insert('relacionado_producto', $data);
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}

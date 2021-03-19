<?php

class Coleccion_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('coleccion', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_foto_coleccion($data)
    {
        $this->db->insert('foto_coleccion', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('coleccion_id', $id);
        $query = $this->db->get('coleccion');

        return $query->row();
    }

    function get_by_coleccion_id($id)
    {
        $this->db->where('coleccion_id', $id);
        $query = $this->db->get('foto_coleccion');

        return $query->result();
    }
    function get_by_foto_coleccion_id($id)
    {
        $this->db->where('foto_coleccion_id', $id);
        $query = $this->db->get('foto_coleccion');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        //$this->db->where('is_active',1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('coleccion');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('coleccion_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('coleccion');
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
        $this->db->where('foto_coleccion_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('foto_coleccion');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('coleccion_id', $id);
        $this->db->delete('coleccion');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function delete_foto_coleccion($id)
    {
        $this->db->where('foto_coleccion_id', $id);
        $this->db->delete('foto_coleccion');
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
    function get_all_productos_by_colecciones($id)
    {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->where('producto.coleccion_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    function search_by_name($name)
    {
        $query = "SELECT * FROM coleccion WHERE name LIKE '%$name%'";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
    function order_price_coleccion($order)
    {
        $query = "SELECT * FROM coleccion order by price $order";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
    function order_name_coleccion($order)
    {
        $query = "SELECT * FROM coleccion order by name $order";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}

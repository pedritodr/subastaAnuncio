<?php

class Mensaje_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('mensaje', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('mensaje_id', $id);
        $query = $this->db->get('mensaje');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        $this->db->where('is_active', 1);
        $this->db->order_by('fecha_creacion', 'DESC');
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('mensaje');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('mensaje_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('mensaje');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('mensaje_id', $id);
        $this->db->delete('mensaje');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    public function activelog($id, $field, $action, $new = null, $old = null)
    {
        $model = 'mensaje';
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


    //------------------------------------------------------------------------------------------------------------------------------------------
}

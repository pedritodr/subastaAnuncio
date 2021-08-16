<?php

class Transfer_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('transfer', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('transfer_id', $id);
        $query = $this->db->get('transfer');

        return $query->row();
    }



    function get_all($conditions = [], $get_as_row = FALSE)
    {
        //$this->db->where('is_active',1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('transfer');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('transfer_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('transfer');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }


    function delete($id)
    {
        $this->db->where('transfer_id', $id);
        $this->db->delete('transfer');
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
    function get_all_requests()
    {
        $this->db->select('transfer.renovate,transfer.transfer_id,transfer.status,transfer.date_create,transfer.date_update,user.user_id,user.name,user.surname,user.phone,user.email,membresia.membresia_id,membresia.nombre,membresia.precio');
        $this->db->from('transfer');
        $this->db->join('user', 'user.user_id = transfer.user_id');
        $this->db->join('membresia', 'membresia.membresia_id = transfer.membresia_id', 'left');
        $this->db->where('transfer.status >=', 0);
        $query = $this->db->get();
        return $query->result();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}

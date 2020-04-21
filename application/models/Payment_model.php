<?php

class Payment_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('payment', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_unico($data)
    {
        $this->db->insert('unico', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_prueba($data)
    {
        $this->db->insert('prueba', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('payment_id', $id);
        $query = $this->db->get('payment');

        return $query->row();
    }
    function get_by_credenciales()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('credenciales');

        return $query->row();
    }

    function get_by_reference_id($id)
    {
        $this->db->where('reference', $id);
        $query = $this->db->get('payment');

        return $query->row();
    }
    function get_by_request_id($id)
    {
        $this->db->where('request_id', $id);
        $query = $this->db->get('payment');

        return $query->row();
    }
    function get_by_payment_user_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->where('status', 0);
        $this->db->or_where('status', 3);
        $query = $this->db->get('payment');

        return $query->result();
    }
    function get_by_payment_user_id_all($id)
    {
        $this->db->where('user_id', $id);
        $this->db->order_by('payment_id', 'asc');
        $query = $this->db->get('payment');

        return $query->result();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->order_by('payment_id', 'desc');
        $query = $this->db->get('payment');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function get_all_transaccion()
    {
        $this->db->where('status', 0);
        $this->db->or_where('status', 3);
        $query = $this->db->get('payment');

        return $query->result();
    }
    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('payment_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('payment');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('payment_id', $id);
        $this->db->delete('payment');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }



    //------------------------------------------------------------------------------------------------------------------------------------------
}

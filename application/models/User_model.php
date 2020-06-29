<?php

class User_model  extends CI_Model
{

    //Siempre Va Fijo
    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }



    function create($data)
    {

        $this->db->insert('user', $data);
        $id = $this->db->insert_id();
        //    $this->activelog($id,$data['email'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('user');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('user');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_client()
    {
        $this->db->where('role_id', '2');
        $query = $this->db->get('user');
        return  $query->result();

    }

   
    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('user_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('user');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function get_user_by_email($email)
    {
        $query = $this->db->get_where("user", ["email" => $email]);
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    function login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->row() : false;
    }
    function is_valid_auth($user_id_decoded, $security_token)
    {
        $query = $this->db->get_where("user", ['user_id' => $user_id_decoded, 'security_token' => $security_token]);
        return ($query->num_rows() > 0) ? $query->row() : false;
    }
}

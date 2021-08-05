<?php

class Transaction_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('transaction', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('transaction_id', $id);
        $query = $this->db->get('transaction');

        return $query->row();
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
        $query = $this->db->get('transaction');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('transaction_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('transaction');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('transaction_id', $id);
        $this->db->delete('transaction');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }
        return $afec;
    }

    function get_all_transaccione_by_id($id)
    {
        $this->db->where("wallet_receives", $id);
        $this->db->or_where("wallet_send", $id);
        $this->db->order_by('timestamp', 'desc');
        $query = $this->db->get('transaction');

        return $query->result();
    }
    function get_all_transfers()
    {
        $this->db->select('transaction.status,user.wallet_bitcoin,user.email_wallet,transaction.bitcoin,transaction.transaction_id,transaction.date_create,transaction.amount,transaction.type,transaction.wallet_send,transaction.status,user.user_id,user.name,user.surname,user.phone,user.email,user.parent as padre,bank_data.name_bank,bank_data.number_account,bank_data.type_account,bank_data.name_titular,bank_data.number_id,bank_data.email as email_bank,bank_data.phone as phone_bank');
        $this->db->from('transaction');
        $this->db->join('wallet', 'wallet.wallet_id = transaction.wallet_send');
        $this->db->join('user', 'user.user_id = wallet.user_id');
        $this->db->join('bank_data', 'bank_data.user_id = user.user_id', 'left');
        /* $this->db->where('transaction.status', 1); */
        $this->db->where('transaction.type', 5);
        $query = $this->db->get();
        return $query->result();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------

}

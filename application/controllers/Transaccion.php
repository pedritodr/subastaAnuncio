<?php

class Transaccion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $request = $this->transaction->get_all_transfers();
        $data['request'] = $request;
        $this->load_view_admin_g("transaction/index", $data);
    }
    public function delete()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            echo json_encode(['status' => 500, 'msj' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $transaction_id = $this->input->post('transaction_id');
        $user_id = $this->input->post('user_id');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $obj_transaction = $this->transaction->get_by_id($transaction_id);
        $fecha = date('Y-m-d H:i:s');
        $wallet = $this->wallet->get_wallet_by_user_id($user_id);
        if ($wallet) {
            $balance = (float)$wallet->balance + (float)$obj_transaction->amount;
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => number_format($obj_transaction->amount, 2),
                'wallet_send' =>  0,
                'type' => 6,
                'balance_previous' => $wallet->balance,
                'balance' => number_format($balance, 2),
                'wallet_receives' => $wallet->wallet_id,
                'status' => 1
            ];
            $this->transaction->create($data_transactions);
            $this->transaction->update($transaction_id, ['status' => 3]);
            $this->wallet->update($wallet->wallet_id, ['balance' => number_format($balance, 2)]);
            echo json_encode(['status' => 200, 'msj' => "Correcto"]);
            exit();
        } else {
            echo json_encode(['status' => 500, 'msj' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }
    public function confirmar()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            echo json_encode(['status' => 500, 'msj' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $transaction_id = $this->input->post('transaction_id');
        $this->load->model('Transaction_model', 'transaction');
        $obj_transaction = $this->transaction->get_by_id($transaction_id);
        if ($obj_transaction) {
            $this->transaction->update($transaction_id, ['status' => 2]);
            echo json_encode(['status' => 200, 'msj' => "Correcto"]);
            exit();
        } else {
            echo json_encode(['status' => 500, 'msj' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }
}

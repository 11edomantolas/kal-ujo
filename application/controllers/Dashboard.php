<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->model('Uangjalan_model', 'uangjalan');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['pending_count'] = $this->uangjalan->countPending();
        $data['payment_count'] = $this->uangjalan->countPayment();
        $data['total_ujo'] = $this->uangjalan->Totalujo();

        // Ambil jumlah pengguna berdasarkan peran
        $data['super_admin_count'] = $this->admin->count_users_by_role('Super_Admin');
        $data['admin_count'] = $this->admin->count_users_by_role('Admin');
        $data['team_leader_count'] = $this->admin->count_users_by_role('Team_Leader');
        $data['operasional_count'] = $this->admin->count_users_by_role('Operasional');
        $data['finance_count'] = $this->admin->count_users_by_role('Finance');

        // 🔹 UJO DONUT STAT
        $status = $this->uangjalan->get_ujo_status_stat();

        $data['ujo_status'] = [
            'pending' => (int) $status->pending,
            'approved' => (int) $status->approved,
            'revision' => (int) $status->revision,
            'rejected' => (int) $status->rejected
        ];
        // 🔹 UJO PAYMENT DONUT STAT
        $payment = $this->uangjalan->get_ujo_payment_stat();

        $data['ujo_payment'] = [
            'paid' => (int) $payment->paid,
            'process' => (int) $payment->process,
            'unpaid' => (int) $payment->unpaid
        ];


        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}

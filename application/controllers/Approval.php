<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_approve_ujo')) {
            redirect('dashboard');
        }
        $this->load->model('Uangjalan_model', 'uangjalan');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    // ===============================
    // Menampilkan data yang pending
    // ===============================
    public function index()
    {
        $data['title'] = 'Approval Uang Jalan';
        $data['pending'] = $this->uangjalan->getPending();
        $this->template->load('templates/dashboard', 'approval/index', $data);
    }

    // ===============================
    // Fungsi APPROVE DATA
    // ===============================
    public function approve($no_cs)
    {
        $this->uangjalan->approve($no_cs);
        $this->session->set_flashdata('success', 'Data berhasil di-approve.');
        redirect('approval');
    }

    // ===============================
    // Fungsi REJECT DATA
    // ===============================
    public function reject()
    {
        $no_cs = $this->input->post('no_cs');
        $catatan = $this->input->post('catatan');

        if (!$catatan) {
            $this->session->set_flashdata('error', 'Catatan wajib diisi jika data ditolak.');
            redirect('approval');
        }

        $this->uangjalan->reject($no_cs, $catatan);
        $this->session->set_flashdata('success', 'Data berhasil ditolak.');
        redirect('approval');
    }
    // ===============================
    // Fungsi REVISION DATA
    // ===============================
    public function revision()
    {
        $no_cs = $this->input->post('no_cs');
        $catatan = $this->input->post('catatan');

        if (!$catatan) {
            $this->session->set_flashdata('error', 'Catatan wajib diisi jika data direvisi.');
            redirect('approval');
        }

        $this->uangjalan->revision($no_cs, $catatan);
        $this->session->set_flashdata('success', 'Data berhasil direvisis.');
        redirect('approval');
    }


}

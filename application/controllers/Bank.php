<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_manage_master_data')) {
            redirect('dashboard');
        }
        $this->load->model('Bank_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    // =====================
    // Menampilkan Data Bank
    // =====================
    public function index()
    {
        $data['title'] = "Data Bank";
        $data['bank'] = $this->Bank_model->get_all();
        $data['active'] = 'bank';

        $this->template->load(
            'templates/dashboard',
            'data master/bank/data',
            $data
        );
    }

    // =====================
    // TAMBAH DATA BANK
    // =====================
    public function add()
    {
        $data['title'] = "Data Bank";

        $this->form_validation->set_rules('kode_bank', 'Kode Bank', 'required|trim');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load(
                'templates/dashboard',
                'data master/bank/add',
                $data
            );
            return;
        }

        // 🔒 AMANKAN INPUT
        $kode_bank = trim($this->input->post('kode_bank'));
        $nama_bank = strtoupper(trim($this->input->post('nama_bank')));

        // 🔥 CEK DUPLIKAT
        $cek = $this->db
            ->group_start()
            ->where('kode_bank', $kode_bank)
            ->or_where('nama_bank', $nama_bank)
            ->group_end()
            ->get('bank')
            ->row();

        if ($cek) {
            $this->session->set_flashdata(
                'error',
                'Kode Bank atau Nama Bank sudah ada!'
            );
            redirect('bank/add');
            return;
        }

        // SIMPAN DATA
        $this->Bank_model->insert([
            'kode_bank' => $kode_bank,
            'nama_bank' => $nama_bank
        ]);

        $this->session->set_flashdata(
            'success',
            'Data Bank berhasil ditambahkan'
        );
        redirect('bank');
    }

    // =====================
    // EDIT DATA BANK
    // =====================
    public function edit($id)
    {
        $data['title'] = "Data Bank";
        $data['bank'] = $this->Bank_model->get_by_id($id);

        if (!$data['bank']) {
            show_404();
        }

        $this->form_validation->set_rules('kode_bank', 'Kode Bank', 'required|trim');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load(
                'templates/dashboard',
                'data master/bank/edit',
                $data
            );
            return;
        }

        // 🔒 AMANKAN INPUT
        $kode_bank = trim($this->input->post('kode_bank'));
        $nama_bank = strtoupper(trim($this->input->post('nama_bank')));

        // 🔥 CEK DUPLIKAT (KECUALI DIRI SENDIRI)
        $cek = $this->db
            ->where('id !=', $id)
            ->group_start()
            ->where('kode_bank', $kode_bank)
            ->or_where('nama_bank', $nama_bank)
            ->group_end()
            ->get('bank')
            ->row();

        if ($cek) {
            $this->session->set_flashdata(
                'error',
                'Kode Bank atau Nama Bank sudah ada!'
            );
            redirect('bank/edit/' . $id);
            return;
        }

        // UPDATE DATA
        $this->Bank_model->update($id, [
            'kode_bank' => $kode_bank,
            'nama_bank' => $nama_bank
        ]);

        $this->session->set_flashdata(
            'success',
            'Data Bank berhasil diperbarui'
        );
        redirect('bank');
    }

    // =====================
    // HAPUS DATA BANK
    // =====================
    public function hapus($id)
    {
        $this->Bank_model->delete($id);
        $this->session->set_flashdata(
            'success',
            'Data Bank berhasil dihapus'
        );
        redirect('bank');
    }
}

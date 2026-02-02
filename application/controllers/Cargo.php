<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cargo extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_manage_master_data')) {
            redirect('dashboard');
        }

        $this->load->model('Cargo_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    // Untuk Menampilkan tampilan data cargo yang ada
    public function index()
    {

        $data['title'] = "Data Cargo";
        $data['cargo'] = $this->Cargo_model->get_all();
        $data['active'] = 'cargo';
        $this->template->load('templates/dashboard', 'data master/cargo/data', $data);
    }

    // Menambah data cargo 
    public function add()
    {
        $data['title'] = "Data Cargo";

        // Aturan validasi
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'data master/cargo/add', $data);
        } else {
            $cargo = $this->input->post('cargo');


            // 🔥 CEK DUPLIKAT di tabel cargo
            $cek = $this->db->where('cargo', $cargo)
                ->get('cargo')
                ->row();
            if ($cek) {
                $this->session->set_flashdata('error', 'Nama Cargo sudah ada, tidak boleh duplikat!');
                redirect('cargo/add'); // kembali ke halaman tambah
            }

            // Jika tidak duplikat → simpan
            $data_insert = [
                'cargo' => $cargo,

            ];
            $this->Cargo_model->insert($data_insert);
            $this->session->set_flashdata('success', 'Data Cargo berhasil ditambahkan!');
            redirect('cargo'); // kembali ke list cargo
        }
    }

    // Mengedit data cargo 
    public function edit($id)
    {
        $data['title'] = "Data Cargo";
        $data['cargo'] = (object) $this->Cargo_model->get_by_id($id);

        if (!$data['cargo']) {
            show_404();
        }

        // Validasi form
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'data master/cargo/edit', $data);
        } else {
            $cargo = $this->input->post('cargo');


            // 🔥 CEK DUPLIKAT SAAT EDIT (kecuali dirinya sendiri)
            $cek = $this->db->where('id !=', $id)
                ->group_start()
                ->where('cargo', $cargo)
                ->group_end()
                ->get('cargo')
                ->row();

            if ($cek) {
                $this->session->set_flashdata('error', 'Kode atau Nama Cargo sudah ada, tidak boleh duplikat!');
                redirect('cargo/edit/' . $id);
            }

            // Jika tidak duplikat → update
            $update_data = [
                'cargo' => $cargo,

            ];
            $this->Cargo_model->update($id, $update_data);
            $this->session->set_flashdata('success', 'Data Cargo berhasil diperbarui!');
            redirect('cargo');
        }
    }

    // Menghapus data cargo 
    public function hapus($id)
    {
        $this->Cargo_model->delete($id);
        redirect('cargo');
    }
}

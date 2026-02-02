<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_manage_master_data')) {
            redirect('dashboard');
        }
        $this->load->model('Tipe_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    // Menampilkan data tipe angkutan
    public function index()
    {
        $data['title'] = "Data Tipe Angkutan";
        $data['bank'] = $this->Tipe_model->get_all();
        $data['active'] = 'tipe';
        $this->template->load('templates/dashboard', 'data master/tipe/data', $data);
    }

    // Menambahkan data tipe angkutan
    public function add()
    {
        $data['title'] = "Data Tipe Angkutan";

        $this->form_validation->set_rules('nama_tipe', 'Nama Tipe', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'data master/tipe/add', $data);
        } else {

            $nama = $this->input->post('nama_tipe');

            // 🔥 CEK DUPLIKAT
            $cek = $this->db->get_where('tipe_angkutan', ['nama_tipe' => $nama])->row();
            if ($cek) {
                $this->session->set_flashdata('error', 'Nama tipe sudah ada, tidak boleh duplikat!');
                redirect('tipe/add'); // kembali ke halaman tambah
            }

            // jika tidak duplikat → simpan
            $data = [
                'nama_tipe' => $nama
            ];
            $this->Tipe_model->insert($data);
            redirect('tipe');
        }
    }

    // Mengedit data tipe angkutan
    public function edit($id)
    {
        $data['title'] = "Data Tipe Angkutan";
        $data['tipe'] = (object) $this->Tipe_model->get_by_id($id);

        if (!$data['tipe']) {
            show_404();
        }

        $this->form_validation->set_rules('nama_tipe', 'Nama Tipe', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'data master/tipe/edit', $data);
        } else {

            $nama = $this->input->post('nama_tipe');

            // 🔥 CEK DUPLIKAT SAAT EDIT (kecuali data dirinya sendiri)
            $cek = $this->db->where('nama_tipe', $nama)
                ->where('id !=', $id) // jangan cek dirinya sendiri
                ->get('tipe_angkutan')
                ->row();

            if ($cek) {
                $this->session->set_flashdata('error', 'Nama tipe sudah ada, tidak boleh duplikat!');
                redirect('tipe/edit/' . $id);
            }

            $update_data = [
                'nama_tipe' => $nama
            ];
            $this->Tipe_model->update($id, $update_data);
            redirect('tipe');
        }
    }

    // Menghapus data tipe angkutan
    public function hapus($id)
    {
        $this->Tipe_model->delete($id);
        redirect('tipe');
    }
}

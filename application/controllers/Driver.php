<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_manage_master_data')) {
            redirect('dashboard');
        }
        $this->load->model('Driver_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Bank_model');
    }

    // Menampilkan data driver yang ada
    public function index()
    {

        $data['title'] = "Data Driver";
        $data['driver'] = $this->Driver_model->get_all();
        $data['bank'] = $this->Bank_model->get_all();
        $this->template->load('templates/dashboard', 'driver/data', $data);
    }

    // Menambah data driver yang ada
    public function add()
    {
        $data['bank'] = $this->Bank_model->get_all();
        $data['title'] = "Data Driver";
        $this->form_validation->set_rules('nama', 'Nama', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'driver/add', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'no_telepon' => $this->input->post('no_telepon'),
                'nama_bank' => $this->input->post('nama_bank'),
                'nomor_rekening' => $this->input->post('nomor_rekening')

            ];
            $this->Driver_model->insert($data);
            redirect('driver');
        }
    }

    // Mengedit data driver yang ada
    public function edit($id)
    {
        $data['bank'] = $this->Bank_model->get_all();
        $data['title'] = "Data Driver";
        $data['driver'] = (object) $this->Driver_model->get_by_id($id);


        if (!$data['driver']) {
            show_404();
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'driver/edit', $data);
        } else {
            $update_data = [
                'nama' => $this->input->post('nama'),
                'no_telepon' => $this->input->post('no_telepon'),
                'nama_bank' => $this->input->post('nama_bank'),
                'nomor_rekening' => $this->input->post('nomor_rekening')

            ];
            $this->Driver_model->update($id, $update_data);
            redirect('driver');
        }
    }

    // Menghapus data driver yang ada
    public function hapus($id)
    {
        $this->Driver_model->delete($id);
        redirect('driver');
    }
}

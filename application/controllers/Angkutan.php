<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Angkutan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Angkutan_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Tipe_model');
    }
    // Menampilkan daftar data angkutan
    public function index()
    {

        $data['title'] = "Data Angkutan";
        $data['angkutan'] = $this->Angkutan_model->get_all();
        $data['tipe_angkutan'] = $this->Tipe_model->get_all();
        $this->template->load('templates/dashboard', 'angkutan/data', $data);
    }

    // Menambahkan daftar data angkutan
    public function add()
    {
        $data['tipe_angkutan'] = $this->Tipe_model->get_all();
        $data['title'] = "Data Angkutan";
        $this->form_validation->set_rules('tipe_angkutan', 'Tipe Angkutan', 'required');

        $this->form_validation->set_rules('nomor_polisi', 'Nomor Polisi', 'required|is_unique[angkutan.nomor_polisi]');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'angkutan/add', $data);
        } else {
            $data = [
                'tipe_angkutan' => $this->input->post('tipe_angkutan'),
                'nomor_polisi' => $this->input->post('nomor_polisi'),

            ];
            $this->Angkutan_model->insert($data);
            redirect('angkutan');
        }
    }

    // Mengedit daftar data angkutan
    public function edit($id)
    {
        $data['tipe_angkutan'] = $this->Tipe_model->get_all();
        $data['title'] = "Data Angkutan";
        $data['angkutan'] = (object) $this->Angkutan_model->get_by_id($id);


        if (!$data['angkutan']) {
            show_404();
        }

        $this->form_validation->set_rules('tipe_angkutan', 'Tipe Angkutan', 'required');

        $this->form_validation->set_rules('nomor_polisi', 'Nomor Polisi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'angkutan/edit', $data);
        } else {
            $update_data = [
                'tipe_angkutan' => $this->input->post('tipe_angkutan'),
                'nomor_polisi' => $this->input->post('nomor_polisi')

            ];
            $this->Angkutan_model->update($id, $update_data);
            redirect('angkutan');
        }
    }

    // Menghapus daftar data angkutan
    public function hapus($id)
    {
        $this->Angkutan_model->delete($id);
        redirect('angkutan');
    }
}

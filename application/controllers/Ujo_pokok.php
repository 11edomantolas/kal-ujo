<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property CI_DB_query_builder $db
 */

class Ujo_pokok extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_manage_master_data')) {
            redirect('dashboard');
        }
        $this->load->model('Ujo_pokok_model');
        $this->load->model('Tipe_model');
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
    }

    // Menampilkan aturan biaya uang jalan
    public function index()
    {
        $data['title'] = "Data Uang Jalan";
        $data['Ujo_pokok'] = $this->Ujo_pokok_model->get_all();

        $this->template->load('templates/dashboard', 'Ujo_pokok/data', $data);
    }

    // Menambahkan aturan biaya uang jalan
    public function add()
    {
        $data['title'] = "Tambah Data Uang Jalan";
        $data['tipe_angkutan'] = $this->Tipe_model->get_all();

        $this->form_validation->set_rules('origin', 'Origin', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');
        $this->form_validation->set_rules('tipe_angkutan', 'Tipe Angkutan', 'required');
        $this->form_validation->set_rules('uang_jalan_pokok', 'Uang Jalan Pokok', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'Ujo_pokok/add', $data);

        } else {

            // 🔥 CEK DUPLIKAT (versi normal, tanpa warning)
            $this->db->where('origin', $this->input->post('origin', TRUE));
            $this->db->where('destination', $this->input->post('destination', TRUE));
            $this->db->where('tipe_angkutan', $this->input->post('tipe_angkutan', TRUE));

            $cek = $this->db->get('uang_jalan_pokok')->num_rows();

            if ($cek > 0) {
                $this->session->set_flashdata(
                    'error',
                    'Data dengan kombinasi Origin, Destination, dan Tipe Angkutan sudah ada!'
                );
                redirect('Ujo_pokok/add');
            }

            // Insert data
            $insert_data = [
                'origin' => $this->input->post('origin', TRUE),
                'destination' => $this->input->post('destination', TRUE),
                'tipe_angkutan' => $this->input->post('tipe_angkutan', TRUE),
                'uang_jalan_pokok' => $this->input->post('uang_jalan_pokok', TRUE),
            ];

            $this->Ujo_pokok_model->insert($insert_data);

            $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
            redirect('Ujo_pokok');
        }
    }

    // Mengedit aturan biaya uang jalan
    public function edit($id)
    {
        $data['title'] = "Edit Data Uang Jalan";
        $data['Ujo_pokok'] = $this->Ujo_pokok_model->get_by_id($id);
        $data['tipe_angkutan'] = $this->Tipe_model->get_all();

        if (!$data['Ujo_pokok']) {
            show_404();
        }

        $this->form_validation->set_rules('origin', 'Origin', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');
        $this->form_validation->set_rules('tipe_angkutan', 'Tipe Angkutan', 'required');
        $this->form_validation->set_rules('uang_jalan_pokok', 'Uang Jalan Pokok', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {

            $this->template->load('templates/dashboard', 'Ujo_pokok/edit', $data);

        } else {

            // 🔥 CEK DUPLIKAT SAAT EDIT
            $this->db->where('origin', $this->input->post('origin', TRUE));
            $this->db->where('destination', $this->input->post('destination', TRUE));
            $this->db->where('tipe_angkutan', $this->input->post('tipe_angkutan', TRUE));
            $this->db->where('id !=', $id);

            $cek = $this->db->get('uang_jalan_pokok')->num_rows();

            if ($cek > 0) {
                $this->session->set_flashdata(
                    'error',
                    'Kombinasi Origin, Destination, dan Tipe Angkutan sudah digunakan!'
                );
                redirect('Ujo_pokok/edit/' . $id);
            }

            // Update data
            $update_data = [
                'origin' => $this->input->post('origin', TRUE),
                'destination' => $this->input->post('destination', TRUE),
                'tipe_angkutan' => $this->input->post('tipe_angkutan', TRUE),
                'uang_jalan_pokok' => $this->input->post('uang_jalan_pokok', TRUE),
            ];

            $this->Ujo_pokok_model->update($id, $update_data);

            $this->session->set_flashdata('success', 'Data berhasil diperbarui!');
            redirect('Ujo_pokok');
        }
    }

    // Menghapus aturan biaya uang jalan
    public function hapus($id)
    {
        $this->Ujo_pokok_model->delete($id);
        redirect('Ujo_pokok');
    }
    public function get_ujo_by_rule($origin, $destination, $tipe)
    {
        $this->db->where('LOWER(origin)', strtolower($origin));
        $this->db->where('LOWER(destination)', strtolower($destination));
        $this->db->where('LOWER(tipe_angkutan)', strtolower($tipe));

        return $this->db->get($this->table)->row_array();
    }
}

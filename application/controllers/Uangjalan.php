<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uangjalan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();  // wajib dipanggil dulu

        cek_login();  // cek login setelah parent

        if (!has_permission('can_view_all_ujo')) {
            redirect('dashboard');
        }
        $this->load->model('Uangjalan_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        $this->load->model('Angkutan_model');
        $this->load->model('Driver_model');
        $this->load->model('Ujo_pokok_model');
        $this->load->model('Tipe_model');
        $this->load->model('Cargo_model');
    }

    // Menampilkan data transaksi uang jalan yang baru dibuat
    public function index()
    {
        $data['title'] = 'Data Uang Jalan';

        // ambil data grup berdasarkan no_cs
        $data['uang_jalan'] = $this->Uangjalan_model->get_grouped_by_no_cs(['Pending', 'Revision', 'Rejected']);

        $data['angkutan'] = $this->Angkutan_model->get_all();
        $data['Ujo_pokok'] = $this->Ujo_pokok_model->get_all();
        $data['nama_tipe'] = $this->Tipe_model->get_all();
        $data['cargo'] = $this->Cargo_model->get_all();

        $this->template->load('templates/dashboard', 'uangjalan/data', $data);
    }

    // Membuat transaksi uang jalan
    public function create()
    {
        $data['title'] = 'Tambah Data Uang Jalan';
        $data['angkutan'] = $this->Angkutan_model->get_all();
        $data['driver'] = $this->Driver_model->get_all();
        $data['tipe_angkutan'] = $this->Tipe_model->get_all();
        $data['cargo'] = $this->Cargo_model->get_all();
        $data['origin'] = $this->Ujo_pokok_model->get_origin_unique();
        $data['destination'] = $this->Ujo_pokok_model->get_destination_unique();
        $data['origin_list'] = $this->Ujo_pokok_model->get_origin_unique();
        $data['destination_list'] = $this->Ujo_pokok_model->get_destination_unique();

        // ===== VALIDASI FORM =====
        $this->form_validation->set_rules('no_cs', 'No CS', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('tipe_pekerjaan', 'Tipe Pekerjaan', 'required');
        $this->form_validation->set_rules('no_unit', 'No Unit', 'required');
        $this->form_validation->set_rules('driver', 'Driver', 'required');
        $this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'required');
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');
        $this->form_validation->set_rules('origin', 'Origin', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');

        // Validasi ritase: minimal 1
        $this->form_validation->set_rules('ritase', 'Ritase', 'required|numeric|greater_than[0]');

        $this->form_validation->set_rules('additional', 'Additional', 'required');
        $this->form_validation->set_rules('vesel', 'Vesel', 'trim');
        $this->form_validation->set_rules('alasan', 'Alasan', 'trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'numeric');

        // ===== CONDITIONAL VALIDATION Additional =====
        $additional = $this->input->post('additional');
        if ($additional == 'ya') {
            $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required');
            $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        }

        // ===== VALIDASI GAGAL =====
        if ($this->form_validation->run() === FALSE) {
            $this->template->load('templates/dashboard', 'uangjalan/add', $data);
        } else {
            // SIMPAN DATA → model insert otomatis handle N rit
            $ritase_inserted = $this->Uangjalan_model->insert();

            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success'>{$ritase_inserted} rit berhasil ditambahkan!</div>"
            );
            redirect('uangjalan');
        }
    }

    // Mengedit data transaki yang baru dibuat
    public function edit_cs($no_cs)
    {
        $data['title'] = 'Edit Data Uang Jalan';

        // ambil data
        $data['uang_jalan'] = $this->Uangjalan_model->get_by_no_cs($no_cs);
        if (empty($data['uang_jalan'])) {
            show_404();
        }
        $status = $data['uang_jalan'][0]['status'];

        if ($status === 'Rejected') {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger">
            Data sudah <b>DITOLAK</b> dan tidak dapat diedit.
        </div>'
            );
            redirect('uangjalan');
        }

        if ($status === 'Approved') {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-warning">
            Data sudah <b>DISETUJUI</b> dan tidak dapat diedit.
        </div>'
            );
            redirect('uangjalan');
        }

        $data['header'] = $data['uang_jalan'][0];
        $data['header']['jumlah_total'] =
            $data['header']['jumlah'] * $data['header']['ritase'];

        // master data
        $data['angkutan'] = $this->Angkutan_model->get_all();
        $data['driver'] = $this->Driver_model->get_all();
        $data['cargo'] = $this->Cargo_model->get_all();
        $data['origin_list'] = $this->Ujo_pokok_model->get_origin_unique();
        $data['destination_list'] = $this->Ujo_pokok_model->get_destination_unique();

        // ===== VALIDASI =====
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('tipe_pekerjaan', 'Tipe Pekerjaan', 'required');
        $this->form_validation->set_rules('no_unit', 'No Unit', 'required');
        $this->form_validation->set_rules('driver', 'Driver', 'required');
        $this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'required');
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');
        $this->form_validation->set_rules('origin', 'Origin', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');
        $this->form_validation->set_rules('ritase', 'Ritase', 'required|numeric');
        $this->form_validation->set_rules('tipe_angkutan', 'Tipe Angkutan', 'required');
        $this->form_validation->set_rules('ujo', 'UJO', 'required|numeric');
        $this->form_validation->set_rules('additional', 'Additional', 'required');

        if ($this->input->post('additional') == 'ya') {
            $this->form_validation->set_rules('alasan', 'Alasan', 'required');
            $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        }

        // ===== TAMPILKAN FORM =====
        if ($this->form_validation->run() === FALSE) {

            $this->template->load(
                'templates/dashboard',
                'uangjalan/edit',
                $data
            );

        } else {

            // ===== UPDATE SEMUA RIT BERDASARKAN no_cs =====
            $updated = $this->Uangjalan_model->update($no_cs);

            if ($updated === false) {

                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger">Update gagal!</div>'
                );

            } else {

                // FIX STATUS
                if ($data['header']['status'] == 'Revision') {
                    $this->Uangjalan_model->update_status($no_cs, 'Pending');
                }

                $this->session->set_flashdata(
                    'pesan',
                    "<div class='alert alert-success'>{$updated} rit berhasil diupdate!</div>"
                );
            }

            redirect('uangjalan');
        }
    }

    // Menghapus data transaksi yang baru dibuat
    public function delete($no_cs)
    {
        $this->Uangjalan_model->delete($no_cs);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data berhasil dihapus!</div>');
        redirect('uangjalan');
    }
    public function get_ujo()
    {
        $origin = $this->input->get('origin', TRUE);
        $destination = $this->input->get('destination', TRUE);
        $tipe = $this->input->get('tipe', TRUE);
        $ritase = $this->input->get('ritase', TRUE); // ambil nilai ritase

        // Jika ritase kosong, set default = 1
        $ritase = (!empty($ritase) && is_numeric($ritase)) ? (int) $ritase : 1;

        $this->load->model('Ujo_pokok_model');

        $result = $this->Ujo_pokok_model->get_ujo($origin, $destination, $tipe);

        if (!empty($result) && isset($result['uang_jalan_pokok'])) {
            $ujo = $result['uang_jalan_pokok'] * $ritase; // dikalikan ritase
            $status = true;
        } else {
            $ujo = 0;
            $status = false;
        }

        echo json_encode([
            'status' => $status,
            'ujo' => $ujo
        ]);
        exit;
    }

}
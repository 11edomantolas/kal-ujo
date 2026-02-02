<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller
{
    private function check_permission($permission)
    {
        if (!has_permission($permission)) {
            redirect('dashboard');
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Uangjalan_model', 'uangjalan');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    // ===============================
    // Pembayaran Partial
    // ===============================

    // Menampilkan list transaksi yang perlu dilakukan pembayaran partial
    public function index()
    {
        $this->check_permission('can_process_payment');
        $data['title'] = 'Partial Payment';
        $data['unpaid'] = $this->uangjalan->getPayment();
        $this->template->load('templates/dashboard', 'payment/index', $data);
    }

    // ===============================
    // Data diubah statusnya dan dilanjutkan export excel_Partial
    // ===============================
    public function process()
    {
        $no_cs_list = json_decode($this->input->post('selectedData'), true);

        if (empty($no_cs_list)) {
            $this->session->set_flashdata('error', 'Tidak ada data dipilih');
            redirect('payment');
        }

        foreach ($no_cs_list as $no_cs) {
            $this->uangjalan->acc($no_cs);
        }

        // simpan no_cs untuk export
        $this->session->set_userdata('export_no_cs', $no_cs_list);

        redirect('payment/export_process_excel');
    }

    public function export_process_excel()
    {
        $no_cs_list = $this->session->userdata('export_no_cs');

        if (empty($no_cs_list)) {
            show_error('Tidak ada data untuk di-export');
        }

        // ambil data dari model
        $data['rows'] = $this->uangjalan->get_export_by_no_cs($no_cs_list);

        $data['filename'] = 'Payment_Uang_Jalan_Partial_' . date('H-i-s');

        // bersihkan session
        $this->session->unset_userdata('export_no_cs');

        // load view excel
        $this->load->view('export/payment_excel', $data);
    }

    // ===============================
    // Pembayaran Full
    // ===============================

    // Menampilkan list transaksi yang perlu dilakukan pembayaran Full
    public function full_payment()
    {
        $this->check_permission('can_process_payment');
        $data['title'] = 'Full Payment';
        $data['full'] = $this->uangjalan->getFullPayment();
        $this->template->load('templates/dashboard', 'payment/full_payment', $data);
    }
    // ===============================
    // Data diubah statusnya dan dilanjutkan export excel_Full
    // ===============================
    public function process_full()
    {
        $ids = json_decode($this->input->post('selectedData'), true);

        if (empty($ids)) {
            $this->session->set_flashdata('error', 'Tidak ada data dipilih');
            redirect('payment/full_payment');
        }

        // SIMPAN DATA SEBELUM DIUBAH
        $data_export = $this->uangjalan->get_export_by_ids($ids);
        $this->session->set_userdata('export_data', $data_export);

        // BARU UPDATE STATUS
        foreach ($ids as $id) {
            $this->uangjalan->acc_full($id);
        }

        redirect('payment/export_process_excel_full');
    }

    public function export_process_excel_full()
    {
        $data['rows'] = $this->session->userdata('export_data');

        if (empty($data['rows'])) {
            show_error('Tidak ada data untuk di-export');
        }

        $data['filename'] = 'Payment_Uang_Jalan_Full_' . date('H-i-s');

        $this->session->unset_userdata('export_data');

        $this->load->view('export/payment_full_excel', $data);
    }


    // ===============================
    // Fungsi yang mengatur Konfirmasi Pekerjaan
    // ===============================

    public function confirm()
    {
        $this->check_permission('can_confirm_job');
        $data['title'] = 'Konfirmasi Pekerjaan';

        $rows = $this->uangjalan->get_process_list();

        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['no_cs']][] = $row;
        }

        $data['process'] = $grouped;

        $this->template->load('templates/dashboard', 'payment/confirm', $data);
    }
    public function konfirmasi_rit($id)
    {
        $this->form_validation->set_rules('no_surat_jalan', 'No Surat Jalan', 'required');
        $this->form_validation->set_rules('tonase', 'Tonase', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            return $this->output
                ->set_status_header(400)
                ->set_output('Invalid data');
        }

        $data = [
            'no_surat_jalan' => $this->input->post('no_surat_jalan'),
            'tonase' => $this->input->post('tonase'),
            'status_pekerjaan' => 'Completed',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->session->set_flashdata('success', 'Rit berhasil dikonfirmasi');
        $this->uangjalan->update_rit($id, $data);
        redirect('payment/confirm');
    }

    // ===============================
    // History diatur disini (export excel dan pdf)
    // ===============================
    public function history()
    {
        $this->check_permission('can_view_payment_history');
        $data['title'] = 'History Transaksi UJO Berhasil';
        $data['paid'] = $this->uangjalan->getHistorySuccess();
        $this->template->load('templates/dashboard', 'riwayat/index', $data);
    }
    public function export_excel()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $keyword = $this->input->get('keyword');

        $data['rows'] = $this->uangjalan
            ->get_export_filtered($start, $end, $keyword);

        // nama file pakai jam
        $data['filename'] = 'Riwayat_Uang_Jalan_' . date('H-i-s');

        $this->load->view('export/uangjalan_excel', $data);
    }

    public function export_pdf()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $keyword = $this->input->get('keyword');

        $data['rows'] = $this->uangjalan
            ->get_export_filtered($start, $end, $keyword);

        $filename = 'Riwayat_Uang_Jalan_' . date('H-i-s');

        $this->load->library('pdf');
        $html = $this->load->view('export/uangjalan_pdf', $data, true);
        $this->pdf->generate($html, $filename);
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uangjalan_model extends MY_Model
{
    private $table = 'uang_jalan';

    public function get_all()
    {
        return $this->db
            ->order_by('tanggal', 'DESC')
            ->order_by("FIELD(status_pembayaran, 'Unpaid', 'Partial', 'Paid')", '', false)
            ->order_by("FIELD(status_pekerjaan, 'Uncompleted', 'Completed')", '', false)
            ->get($this->table)
            ->result_array();
    }


    // Data Yang Tampil di Uang Jalan akan digrup 
    public function get_grouped_by_no_cs($status = [])
    {
        $this->db->select("
        no_cs,
        MAX(id) AS id,
        MAX(rit_ke) AS rit_ke,
        MAX(tanggal) AS tanggal,
        MAX(tipe_pekerjaan) AS tipe_pekerjaan,
        MAX(no_unit) AS no_unit,
        GROUP_CONCAT(DISTINCT driver SEPARATOR ', ') AS driver,
        MAX(nomor_rekening) AS nomor_rekening,
        MAX(nama_bank) AS nama_bank,
        MAX(no_surat_jalan) AS no_surat_jalan,
        MAX(tonase) AS tonase,
        MAX(cargo) AS cargo,
        MAX(origin) AS origin,
        MAX(destination) AS destination,
        MAX(ritase) AS ritase,
        MAX(tipe_angkutan) AS tipe_angkutan,
        MAX(vesel) AS vesel,
        MAX(additional) AS additional,
        MAX(alasan) AS alasan,
        SUM(jumlah) AS jumlah,
        SUM(ujo) AS ujo,
        SUM(ujo_terbayar) AS ujo_terbayar,
        SUM(ujo_sisa) AS ujo_sisa,
        MAX(status) AS status,
        MAX(status_pekerjaan) AS status_pekerjaan,
        MAX(catatan) AS catatan,
        MAX(status_pembayaran) AS status_pembayaran
    ");

        $this->db->from($this->table);

        if (!empty($status)) {
            $this->db->where_in('status', $status);
        }

        $this->db->group_by('no_cs');

        $this->db->order_by("
        CASE status
            WHEN 'Pending' THEN 1
            WHEN 'Revision' THEN 2
            WHEN 'Rejected' THEN 3
            ELSE 4
        END
    ", 'ASC');

        $this->db->order_by('tanggal', 'DESC');

        return $this->db->get()->result_array();
    }
    public function insert()
    {
        $nomor_rekening = $this->input->post('nomor_rekening', true);
        $driver_data = $this->Driver_model->get_by_rekening($nomor_rekening);
        $nama_bank = $driver_data ? $driver_data->nama_bank : null;

        $ujo_total = (int) $this->input->post('ujo', true); // TOTAL dari form
        $ritase = (int) $this->input->post('ritase', true);
        $jumlah_total = (int) $this->input->post('jumlah', true);
        $jumlah_per_rit = $ritase > 0 ? floor($jumlah_total / $ritase) : 0;


        $ujo_per_rit = $ritase > 0 ? ($ujo_total / $ritase) : 0;
        $count = 0;

        for ($i = 1; $i <= $ritase; $i++) {
            $data = [
                'no_cs' => $this->input->post('no_cs', true),
                'rit_ke' => $i,
                'tanggal' => $this->input->post('tanggal', true),
                'tipe_pekerjaan' => $this->input->post('tipe_pekerjaan', true),
                'no_unit' => $this->input->post('no_unit', true),
                'driver' => $this->input->post('driver', true),
                'nomor_rekening' => $nomor_rekening,
                'nama_bank' => $nama_bank,
                'cargo' => $this->input->post('cargo', true),
                'origin' => $this->input->post('origin', true),
                'destination' => $this->input->post('destination', true),
                'ritase' => $ritase,
                'tipe_angkutan' => $this->input->post('tipe_angkutan', true),
                'vesel' => $this->input->post('vesel', true),
                'additional' => $this->input->post('additional', true),
                'alasan' => $this->input->post('alasan', true),
                'jumlah' => $jumlah_per_rit,
                'ujo' => $ujo_per_rit,
                'ujo_terbayar' => 0,
                'ujo_sisa' => $ujo_per_rit,
                'status_pembayaran' => 'Unpaid'
            ];

            if ($this->db->insert($this->table, $data)) {
                $count++;
            }
        }

        return $count; // jumlah rit yang berhasil di-insert
    }



    public function update($no_cs)
    {
        $old_rit = $this->db
            ->order_by('rit_ke', 'ASC')
            ->get_where($this->table, ['no_cs' => $no_cs])
            ->result_array();

        if (!$old_rit)
            return false;

        $ujo_total = (int) $this->input->post('ujo', true); // TOTAL
        $rit_baru = (int) $this->input->post('ritase', true);
        $jumlah_total = (int) $this->input->post('jumlah', true);
        $jumlah_per_rit = $rit_baru > 0 ? floor($jumlah_total / $rit_baru) : 0;


        $total_terbayar = array_sum(array_column($old_rit, 'ujo_terbayar'));
        if ($ujo_total < $total_terbayar)
            return false;

        $ujo_per_rit = $rit_baru > 0 ? ($ujo_total / $rit_baru) : 0;

        $nomor_rekening = $this->input->post('nomor_rekening', true);
        $driver_data = $this->Driver_model->get_by_rekening($nomor_rekening);
        $nama_bank = $driver_data ? $driver_data->nama_bank : null;

        $data_global = [
            'tanggal' => $this->input->post('tanggal', true),
            'tipe_pekerjaan' => $this->input->post('tipe_pekerjaan', true),
            'no_unit' => $this->input->post('no_unit', true),
            'driver' => $this->input->post('driver', true),
            'nomor_rekening' => $nomor_rekening,
            'nama_bank' => $nama_bank,
            'cargo' => $this->input->post('cargo', true),
            'origin' => $this->input->post('origin', true),
            'destination' => $this->input->post('destination', true),
            'tipe_angkutan' => $this->input->post('tipe_angkutan', true),
            'vesel' => $this->input->post('vesel', true),
            'additional' => $this->input->post('additional', true),
            'alasan' => $this->input->post('alasan', true),
            'jumlah' => $jumlah_per_rit,
            'ujo' => $ujo_per_rit,
            'ujo_sisa' => $ujo_per_rit - $total_terbayar,
            'ritase' => $rit_baru,
            'catatan' => NULL,
        ];

        $updated = 0;
        $rit_lama = count($old_rit);

        for ($i = 0; $i < min($rit_lama, $rit_baru); $i++) {
            $this->db->where('id', $old_rit[$i]['id'])
                ->update($this->table, $data_global);
            $updated++;
        }

        for ($i = $rit_lama + 1; $i <= $rit_baru; $i++) {
            $insert = $data_global;
            $insert['no_cs'] = $no_cs;
            $insert['rit_ke'] = $i;
            $insert['ujo_terbayar'] = 0;
            $this->db->insert($this->table, $insert);
            $updated++;
        }

        if ($rit_baru < $rit_lama) {
            foreach ($old_rit as $rit) {
                if ($rit['rit_ke'] > $rit_baru && $rit['ujo_terbayar'] == 0) {
                    $this->db->delete($this->table, ['id' => $rit['id']]);
                }
            }
        }

        return $updated;
    }

    public function get_by_no_cs($no_cs)
    {
        return $this->db
            ->where('no_cs', $no_cs)
            ->order_by('rit_ke', 'ASC')
            ->get('uang_jalan')
            ->result_array();
    }


    public function update_status($no_cs, $status)
    {
        return $this->db->update(
            $this->table,
            ['status' => $status],
            ['no_cs' => $no_cs]
        );
    }

    public function delete($no_cs)
    {
        return $this->db->delete($this->table, ['no_cs' => $no_cs]);
    }

    public function Totalujo()
    {
        return $this->db->count_all($this->table);
    }

    /* ===========================
       STATUS DATA 
       =========================== */

    public function getPending()
    {
        $this->db->select("
        no_cs,

        MAX(id) AS id,
        MAX(rit_ke) AS rit_ke,
        MAX(tanggal) AS tanggal,
        MAX(tipe_pekerjaan) AS tipe_pekerjaan,
        MAX(no_unit) AS no_unit,
        GROUP_CONCAT(DISTINCT driver SEPARATOR ', ') AS driver,
        MAX(nomor_rekening) AS nomor_rekening,
        MAX(nama_bank) AS nama_bank,
        MAX(no_surat_jalan) AS no_surat_jalan,
        MAX(tonase) AS tonase,
        MAX(cargo) AS cargo,
        MAX(origin) AS origin,
        MAX(destination) AS destination,
        MAX(ritase) AS ritase,
        MAX(tipe_angkutan) AS tipe_angkutan,
        MAX(vesel) AS vesel,
        MAX(additional) AS additional,
        MAX(alasan) AS alasan,
        SUM(jumlah) AS jumlah,
        SUM(ujo) AS ujo,
        SUM(ujo_terbayar) AS ujo_terbayar,
        SUM(ujo_sisa) AS ujo_sisa,
        MAX(status) AS status,
        MAX(status_pekerjaan) AS status_pekerjaan,
        MAX(catatan) AS catatan,
        MAX(status_pembayaran) AS status_pembayaran
    ");

        $this->db->from($this->table);

        // 🔹 khusus Pending
        $this->db->where('status', 'Pending');

        $this->db->group_by('no_cs');

        $this->db->order_by('tanggal', 'DESC');

        return $this->db->get()->result_array();
    }

    public function countPending()
    {
        return $this->db->where('status', 'Pending')
            ->from($this->table)
            ->count_all_results();
    }

    public function approve($no_cs)
    {
        return $this->db->where('no_cs', $no_cs)
            ->update($this->table, [
                'status' => 'Approved',
                'catatan' => NULL,
                'status_pembayaran' => 'Unpaid'
            ]);
    }

    public function reject($no_cs, $catatan)
    {
        return $this->db->where('no_cs', $no_cs)
            ->update($this->table, [
                'status' => 'Rejected',
                'catatan' => $catatan,
                'status_pembayaran' => 'Unpaid'
            ]);
    }

    public function revision($no_cs, $catatan)
    {
        return $this->db->where('no_cs', $no_cs)
            ->update($this->table, [
                'status' => 'Revision',
                'catatan' => $catatan,
                'status_pembayaran' => 'Unpaid'
            ]);
    }


    /* ===========================
       Proses PEMBAYARAN Partial
       =========================== */
    public function getPayment()
    {
        $this->db->select("
        no_cs,

        MAX(id) AS id,
        MAX(rit_ke) AS rit_ke,
        MAX(tanggal) AS tanggal,
        MAX(tipe_pekerjaan) AS tipe_pekerjaan,
        MAX(no_unit) AS no_unit,
        GROUP_CONCAT(DISTINCT driver SEPARATOR ', ') AS driver,
        MAX(nomor_rekening) AS nomor_rekening,
        MAX(nama_bank) AS nama_bank,
        MAX(no_surat_jalan) AS no_surat_jalan,
        MAX(tonase) AS tonase,
        MAX(cargo) AS cargo,
        MAX(origin) AS origin,
        MAX(destination) AS destination,
        MAX(ritase) AS ritase,
        MAX(tipe_angkutan) AS tipe_angkutan,
        MAX(vesel) AS vesel,
        MAX(additional) AS additional,
        MAX(alasan) AS alasan,
        MAX(jumlah) AS jumlah,
        SUM(ujo) AS ujo,
        SUM(ujo_terbayar) AS ujo_terbayar,
        SUM(ujo_sisa) AS ujo_sisa,
        MAX(status) AS status,
        MAX(status_pekerjaan) AS status_pekerjaan,
        MAX(catatan) AS catatan,
        MAX(status_pembayaran) AS status_pembayaran
    ");

        $this->db->from($this->table);

        $this->db->where('status', 'Approved');
        $this->db->where('status_pembayaran', 'Unpaid');
        $this->db->group_by('no_cs');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get()->result_array();
    }


    public function countPayment()
    {
        return $this->db
            ->where('status', 'Approved')
            ->where('status_pembayaran', 'Unpaid')
            ->from($this->table)
            ->count_all_results();
    }


    public function acc($no_cs)
    {
        // ambil semua rit dalam CS
        $rows = $this->db
            ->where('no_cs', $no_cs)
            ->where_in('status_pembayaran', ['Unpaid', 'Partial'])
            ->get('uang_jalan')
            ->result_array();

        if (empty($rows)) {
            return false;
        }

        foreach ($rows as $row) {

            // jika rit ini sudah lunas, skip
            if ($row['ujo_sisa'] <= 0) {
                continue;
            }

            $ujo = (int) $row['ujo'];

            // 80% PER RIT
            $bayar = round($ujo * 0.8);

            // jaga-jaga jika sisa < 80%
            if ($row['ujo_sisa'] < $bayar) {
                $bayar = $row['ujo_sisa'];
            }

            $ujo_terbayar_baru = $row['ujo_terbayar'] + $bayar;
            $ujo_sisa_baru = $ujo - $ujo_terbayar_baru;

            $status = ($ujo_sisa_baru <= 0) ? 'Paid' : 'Partial';

            $this->db->where('id', $row['id']);
            $this->db->update('uang_jalan', [
                'ujo_terbayar' => $ujo_terbayar_baru,
                'ujo_sisa' => $ujo_sisa_baru,
                'status_pembayaran' => $status
            ]);
        }

        return true;
    }
    public function get_export_by_no_cs(array $no_cs_list)
    {
        if (empty($no_cs_list)) {
            return [];
        }

        $this->db->select("
        no_cs,
        GROUP_CONCAT(DISTINCT driver SEPARATOR ', ') AS driver,
        MAX(nama_bank) AS nama_bank,
        MAX(nomor_rekening) AS nomor_rekening,
        SUM(ujo_terbayar) AS ujo_terbayar
    ");

        $this->db->from('uang_jalan');
        $this->db->where_in('no_cs', $no_cs_list);
        $this->db->group_by('no_cs');

        return $this->db->get()->result_array();
    }

    /* ===========================
           Proses PEMBAYARAN FULL
           =========================== */
    public function getFullPayment()
    {
        return $this->db->where('status', 'Approved')
            ->where('status_pembayaran', 'Partial')
            ->where('status_pekerjaan', 'Completed')
            ->order_by('tanggal', 'DESC')
            ->get($this->table)
            ->result_array();
    }
    public function process_full()
    {
        return $this->db
            ->where('status_pembayaran', 'Paid')
            ->where('status_pekerjaan', 'Completed')
            ->order_by('nama', 'ASC')
            ->get('uang_jalan')
            ->result_array();
    }
    public function acc_full($id)
    {
        $row = $this->db->get_where('uang_jalan', ['id' => $id])->row_array();
        if (!$row) {
            return false;
        }

        // jika sudah lunas, hentikan
        if ($row['ujo_sisa'] <= 0) {
            return false;
        }

        // bayar sisa (20% atau berapa pun yang tersisa)
        $bayar = $row['ujo_sisa'];

        $data = [
            'ujo_terbayar' => $row['ujo_terbayar'] + $bayar,
            'ujo_sisa' => 0,
            'status_pembayaran' => 'Paid'
        ];

        $this->db->where('id', $id);
        return $this->db->update('uang_jalan', $data);
    }
    // ini untuk export di bagian payment Full
    public function get_export_by_ids($ids)
    {
        $this->db->select('
        no_cs,
        tanggal,
        tipe_pekerjaan,
        no_unit,
        driver,
        nomor_rekening,
        nama_bank,
        no_surat_jalan,
        tonase,
        cargo,
        origin,
        destination,
        ritase,
        tipe_angkutan,
        vesel,
        alasan,
        jumlah,
        ujo_terbayar,
        ujo_sisa,
        status,
        status_pembayaran
    ');
        $this->db->from('uang_jalan');
        $this->db->where_in('id', $ids);

        return $this->db->get()->result();
    }

    public function get_process_list()
    {
        return $this->db
            ->select("
            no_cs,
            MAX(id) AS id,
            MAX(rit_ke) AS rit_ke,
            MAX(tanggal) AS tanggal,
            MAX(tipe_pekerjaan) AS tipe_pekerjaan,
            MAX(no_unit) AS no_unit,
            GROUP_CONCAT(DISTINCT driver SEPARATOR ', ') AS driver,
            MAX(nomor_rekening) AS nomor_rekening,
            MAX(nama_bank) AS nama_bank,
            MAX(no_surat_jalan) AS no_surat_jalan,
            MAX(tonase) AS tonase,
            MAX(cargo) AS cargo,
            MAX(origin) AS origin,
            MAX(destination) AS destination,
            MAX(ritase) AS ritase,
            MAX(tipe_angkutan) AS tipe_angkutan,
            MAX(vesel) AS vesel,
            MAX(additional) AS additional,
            MAX(alasan) AS alasan,
            MAX(jumlah) AS jumlah,
            SUM(ujo) AS ujo,
            SUM(ujo_terbayar) AS ujo_terbayar,
            SUM(ujo_sisa) AS ujo_sisa,
            MAX(status) AS status,
            MAX(status_pekerjaan) AS status_pekerjaan,
            MAX(catatan) AS catatan,
            MAX(status_pembayaran) AS status_pembayaran
        ", false)
            ->from('uang_jalan')
            ->where('status_pembayaran', 'Partial')
            ->where('status_pekerjaan', 'Uncompleted')
            ->group_by('no_cs')
            ->order_by('tanggal', 'DESC')
            ->get()
            ->result_array();
    }


    public function update_rit($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('uang_jalan', $data);
    }

    /* ===========================
               History
               =========================== */
    public function getHistorySuccess()
    {
        return $this->db
            ->where('status', 'Approved')
            ->where('status_pembayaran', 'Paid')
            ->where('status_pekerjaan', 'Completed')
            ->order_by('tanggal', 'DESC')
            ->get('uang_jalan')
            ->result_array();
    }
    // ini untuk export di bagian History
    public function get_export_data_all()
    {
        $this->db->select('
        no_cs,
        tanggal,
        tipe_pekerjaan,
        no_unit,
        driver,
        nomor_rekening,
        nama_bank,
        no_surat_jalan,
        tonase,
        cargo,
        origin,
        destination,
        ritase,
        tipe_angkutan,
        vesel,
        alasan,
        jumlah,
        ujo,
        status,
        status_pembayaran
    ');
        $this->db->from('uang_jalan');
        $this->db->where('status_pembayaran', 'Paid');
        return $this->db->get()->result();
    }
    public function get_export_filtered($start, $end, $keyword)
    {
        $this->db->from('uang_jalan');
        $this->db->where('status_pembayaran', 'Paid');

        // filter tanggal
        if ($start && $end) {
            $this->db->where('tanggal >=', $start);
            $this->db->where('tanggal <=', $end);
        }

        // filter general (LIKE ke banyak kolom)
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('no_cs', $keyword);
            $this->db->or_like('no_unit', $keyword);
            $this->db->or_like('driver', $keyword);
            $this->db->or_like('origin', $keyword);
            $this->db->or_like('destination', $keyword);
            $this->db->or_like('cargo', $keyword);
            $this->db->or_like('no_surat_jalan', $keyword);
            $this->db->group_end();
        }

        return $this->db->get()->result();
    }

    // Bagian tampil di dashboard
    public function get_ujo_status_stat()
    {
        return $this->db->query("
        SELECT
            SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending,
            SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) AS approved,
            SUM(CASE WHEN status = 'Revision' THEN 1 ELSE 0 END) AS revision,
            SUM(CASE WHEN status = 'Rejected' THEN 1 ELSE 0 END) AS rejected
        FROM uang_jalan
    ")->row();
    }

    public function get_ujo_payment_stat()
    {
        return $this->db->query("
        SELECT
            SUM(CASE WHEN status_pembayaran = 'Paid' THEN 1 ELSE 0 END) AS paid,
            SUM(CASE WHEN status_pembayaran = 'Partial' THEN 1 ELSE 0 END) AS process,
            SUM(CASE WHEN status_pembayaran = 'Unpaid' THEN 1 ELSE 0 END) AS unpaid
        FROM uang_jalan
    ")->row();
    }

}

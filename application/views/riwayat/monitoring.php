<!-- <?= $this->session->flashdata('pesan'); ?> -->

<div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
    <div class="card-header text-white py-3" style="background: linear-gradient(90deg, #0056b3, #007bff);">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h4 class="m-0 fw-bold">
                <i class="fas fa-money-check-alt me-2"></i> Monitrong Transaksi UJO
            </h4>
        </div>
    </div>

    <div class="card-body bg-light">

        <!-- ================= FILTER ================= -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="fw-semibold">Dari Tanggal</label>
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="fw-semibold">Sampai Tanggal</label>
                <input type="date" id="endDate" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="fw-semibold">Filter Data</label>
                <input type="text" id="keyword" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button id="resetFilter" class="btn btn-secondary w-100">
                    Reset
                </button>
            </div>
        </div>
        <!-- <div class="mb-3 text-end">
            <button id="exportExcel" class="btn btn-success btn-sm">
                <i class="fa fa-file-excel"></i> Export Excel
            </button>
            <button id="exportPdf" class="btn btn-danger btn-sm">
                <i class="fa fa-file-pdf"></i> Export PDF
            </button>
        </div> -->

        <!-- ================= TABLE ================= -->
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="uangJalanTable">
                <thead class="table-primary text-center">
                    <tr>
                        <th class='text-center'>No</th>
                        <th class='text-center'>No CS</th>
                        <th class='text-center'>Tanggal</th>
                        <th class='text-center'>Driver</th>
                        <th class='text-center'>Status Approval</th>
                        <th class='text-center'>Status Pembayaran</th>
                        <th class='text-center'>Status Pekerjaan</th>
                        <th class='text-center'>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($all)):
                        $no = 1;
                        foreach ($all as $data): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['no_cs']; ?></td>
                                <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                                <td><?= $data['driver']; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($data['status'] == 'Approved') {
                                        $badgeClass = 'bg-success text-white';
                                    } elseif ($data['status'] == 'Pending') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif ($data['status'] == 'Rejected') {
                                        $badgeClass = 'bg-danger text-white';
                                    } elseif ($data['status'] == 'Revision') {
                                        $badgeClass = 'bg-orange text-white';
                                    } else {
                                        $badgeClass = 'bg-secondary text-white';
                                    }
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $data['status']; ?></span>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($data['status_pembayaran'] == 'Paid') {
                                        $badgeClass = 'bg-success text-white';
                                    } elseif ($data['status_pembayaran'] == 'Partial') {
                                        $badgeClass = 'bg-orange text-white';
                                    } elseif ($data['status_pembayaran'] == 'Unpaid') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } else {
                                        $badgeClass = 'bg-secondary text-white';
                                    }
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $data['status_pembayaran']; ?></span>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($data['status_pekerjaan'] == 'Completed') {
                                        $badgeClass = 'bg-success text-white';
                                    } elseif ($data['status_pekerjaan'] == 'Uncompleted') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } else {
                                        $badgeClass = 'bg-secondary text-white';
                                    }
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $data['status_pekerjaan']; ?></span>
                                </td>
                                <!-- AKSI -->
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">

                                        <!-- DETAIL -->
                                        <button type="button" class="btn btn-info text-white" data-toggle="modal"
                                            data-target="#detailModal<?= $data['id']; ?>">
                                            <i class="fa fa-eye"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailModal<?= $data['id']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content rounded-4 shadow">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title fw-bold"><i class="fas fa-info-circle me-2"></i>Detail Uang
                                                Jalan</h5>
                                            <button type="button" class="btn-close text-white" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-light">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>No CS:</strong> <?= $data['no_cs']; ?></p>
                                                    <p><strong>Tanggal:</strong>
                                                        <?= date('d-m-Y', strtotime($data['tanggal'])); ?></p>
                                                    <p><strong>Tipe Pekerjaan:</strong> <?= $data['tipe_pekerjaan']; ?></p>
                                                    <?php
                                                    $vesel = trim($data['vesel'] ?? '');
                                                    ?>
                                                    <p><strong>Vesel:</strong> <?= $vesel !== '' ? $vesel : '-' ?></p>
                                                    <p><strong>No Unit:</strong> <?= $data['no_unit']; ?></p>
                                                    <p><strong>Tipe Angkutan:</strong> <?= $data['tipe_angkutan']; ?></p>
                                                    <p><strong>Driver:</strong> <?= $data['driver']; ?></p>
                                                    <p><strong>Nomor Rekening Driver:</strong> <?= $data['nomor_rekening']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Cargo:</strong> <?= $data['cargo']; ?></p>
                                                    <p><strong>Tonase:</strong> <?= number_format($data['tonase'], 2); ?></p>
                                                    <p><strong>Origin:</strong> <?= $data['origin']; ?></p>
                                                    <p><strong>Destination:</strong> <?= $data['destination']; ?></p>
                                                    <p><strong>Ritase:</strong> <?= $data['ritase']; ?></p>
                                                    <?php
                                                    $alasan = trim($data['alasan'] ?? '');
                                                    ?>
                                                    <?php
                                                    $no_surat_jalan = trim($data['no_surat_jalan'] ?? '');
                                                    ?>
                                                    <p><strong>No Surat Jalan:</strong>
                                                        <?= $no_surat_jalan !== '' ? $no_surat_jalan : '-' ?>
                                                    <p><strong>Alasan Additional:</strong> <?= $alasan !== '' ? $alasan : '-' ?>
                                                    </p>
                                                    <?php
                                                    $jumlah = trim($data['jumlah'] ?? '');
                                                    ?>
                                                    <p>
                                                        <strong>Jumlah Additional (Rp):</strong>Rp.
                                                        <?= $jumlah !== '' ? number_format($jumlah, 0, ',', '.') : '-' ?>
                                                    </p>
                                                    <p>
                                                        <strong> Total UJO (Rp):</strong>
                                                        <span class="text-primary fw-semibold">
                                                            Rp.<?= number_format($data['ujo'], 0, ',', '.'); ?>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <strong> UJO Terbayar (Rp):</strong>
                                                        <span class="text-success fw-semibold">
                                                            Rp.<?= number_format($data['ujo_terbayar'], 0, ',', '.'); ?>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <strong> Sisa UJO (Rp):</strong>
                                                        <span class="text-danger fw-semibold">
                                                            Rp.<?= number_format($data['ujo_sisa'], 0, ',', '.'); ?>
                                                        </span>
                                                    </p>
                                                    <p><strong>Status:</strong>
                                                        <?= strtolower($data['status_pembayaran']) === 'paid'
                                                            ? 'Lunas'
                                                            : ucfirst(strtolower($data['status_pembayaran'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-white">
                                            <button type="button" class="btn btn-secondary rounded-pill"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    else: ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ===== Styling Modern & Responsif ===== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    .table thead th {
        font-weight: 700;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        padding: 7px;
    }

    #uangJalanTable tbody td {
        color: #212529;
        padding: 4px 7px;
        /* ini yang paling berasa */
        font-size: 15px;
        /* lebih padat */
        line-height: 2;
        vertical-align: middle;

    }

    #uangJalanTable tbody tr:hover td {
        color: #0d6efd;
    }

    .table tbody tr:hover {
        background-color: #f0f8ff !important;
        transition: 0.2s;
    }

    .dataTables_wrapper .dt-buttons {
        margin-bottom: 10px;
    }

    .btn-group .btn {
        margin-right: 4px;
    }

    @media (max-width: 768px) {
        table thead {
            display: none;
        }

        table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
        }

        table tbody td {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            padding: 5px 0;
        }

        table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #007bff;
        }
    }

    #uangJalanTable.dataTable thead th {
        text-align: center !important;
        white-space: nowrap;
    }

    .bg-orange {
        background-color: #fd7e14 !important;
        /* Bootstrap Orange */

    }

    /* ===== SERAGAMKAN TEXT FILTER & SEARCH ===== */
    .card-body label,
    .dataTables_filter label,
    .dataTables_info {
        color: #212529 !important;
        /* text-dark Bootstrap */
        font-weight: 600;
    }
</style>

<!-- ===== JS Plugins ===== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- ===== DataTables Init + Filter ===== -->
<script>
    // ================= CUSTOM FILTER =================
    $(document).ready(function () {
        const table = $('#uangJalanTable').DataTable({
            language: { emptyTable: "History tidak ditemukan" },
            pageLength: 10
        });

        // keyword search (semua kolom)
        $('#keyword').on('keyup', function () {
            table.search(this.value).draw();
        });

        // filter tanggal range
        $.fn.dataTable.ext.search.push(function (settings, data) {
            let start = $('#startDate').val();
            let end = $('#endDate').val();
            let date = data[2]; // kolom tanggal (d-m-Y)

            if (!start && !end) return true;

            let parts = date.split('-');
            let rowDate = new Date(parts[2], parts[1] - 1, parts[0]);

            if (start && rowDate < new Date(start)) return false;
            if (end && rowDate > new Date(end)) return false;

            return true;
        });

        $('#startDate, #endDate').on('change', function () {
            table.draw();
        });

        $('#resetFilter').click(function () {
            $('#startDate, #endDate, #keyword').val('');
            table.search('').draw();
        });
    });
</script>
<script>
    function validateExport() {
        const start = $('#startDate').val();
        const end = $('#endDate').val();
        const table = $('#uangJalanTable').DataTable();
        const totalData = table.rows({ filter: 'applied' }).count();

        // validasi tanggal
        if (start && end && end < start) {
            alert('Tanggal "Sampai" tidak boleh lebih kecil dari "Dari"');
            return false;
        }

        // validasi data kosong
        if (totalData === 0) {
            alert('Data kosong, tidak bisa melakukan export');
            return false;
        }

        return true;
    }

    function getFilterParams() {
        return {
            start: $('#startDate').val(),
            end: $('#endDate').val(),
            keyword: $('#keyword').val()
        };
    }

    $('#exportExcel').click(function () {
        if (!validateExport()) return;

        const p = getFilterParams();
        window.location.href =
            "<?= base_url('payment/export_excel') ?>" +
            "?start=" + p.start +
            "&end=" + p.end +
            "&keyword=" + encodeURIComponent(p.keyword);
    });

    $('#exportPdf').click(function () {
        if (!validateExport()) return;

        const p = getFilterParams();
        window.location.href =
            "<?= base_url('payment/export_pdf') ?>" +
            "?start=" + p.start +
            "&end=" + p.end +
            "&keyword=" + encodeURIComponent(p.keyword);
    });
</script>
<script>
    $('#startDate').on('change', function () {
        let start = $(this).val();
        $('#endDate').attr('min', start);

        // kalau endDate sudah diisi tapi lebih kecil → reset
        if ($('#endDate').val() && $('#endDate').val() < start) {
            $('#endDate').val('');
        }
    });
</script>

<!-- ====================== DATATABLE SCRIPT ====================== -->

<style>
    .dataTables_wrapper .dt-buttons {
        margin-bottom: 15px !important;
    }

    .dt-buttons .btn {
        margin-right: 8px !important;
    }
</style>
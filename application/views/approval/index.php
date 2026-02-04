<!-- <?php if ($this->session->flashdata('pesan')): ?>
    <div class="mt-2">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
<?php endif; ?> -->

<div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
    <div class="card-header text-white py-3" style="background: linear-gradient(90deg, #0056b3, #007bff);">
        <h4 class="m-0 fw-bold">
            <i class="fas fa-money-check-alt me-2"></i> Approval Uang Jalan
        </h4>
    </div>

    <div class="card-body bg-light">

        <!-- ======================== FILTER =========================== -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="fw-semibold text-dark">Filter Tanggal</label>
                <input type="date" id="filterTanggal" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="fw-semibold text-dark">Filter No CS</label>
                <input type="text" id="filterNocs" class="form-control" placeholder="No CS">
            </div>

            <div class="col-md-3">
                <label class="fw-semibold text-dark">Filter No Unit</label>
                <input type="text" id="filterNounit" class="form-control" placeholder="No Unit">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button id="resetFilter" class="btn btn-secondary w-100">
                    <i class="fa fa-undo me-1"></i> Reset Filter
                </button>
            </div>
        </div>

        <!-- ====================== TABEL ============================= -->
        <table class="table table-hover align-middle text-dark w-100" id="uangJalanTable">
            <thead class="table-primary text-center text-nowrap">
                <tr>
                    <th class="text-center col-id">No CS</th>
                    <th class="text-center col-date">Tanggal</th>
                    <th class="text-center col-unit">No Unit</th>
                    <th class="text-center col-text">Driver</th>
                    <th class="text-center col-short">Cargo</th>
                    <th class="text-center col-text">Origin</th>
                    <th class="text-center col-text">Destination</th>
                    <th class="text-center col-status">Status</th>
                    <th class="text-center col-action">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($pending as $data): ?>
                    <tr>
                        <td><?= $data['no_cs']; ?></td>
                        <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                        <td><?= $data['no_unit']; ?></td>
                        <td><?= $data['driver']; ?></td>
                        <td><?= $data['cargo']; ?></td>
                        <td><?= $data['origin']; ?></td>
                        <td><?= $data['destination']; ?></td>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark">Pending</span>
                        </td>

                        <td class="text-center">
                            <div class="btn-group btn-group-sm">

                                <!-- Detail -->
                                <button class="btn btn-info" data-bs-toggle-tooltip="tooltip" title="Lihat Detail"
                                    data-bs-toggle="modal" data-bs-target="#detailModal_<?= $data['no_cs']; ?>">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Approve -->
                                <a href="<?= base_url('approval/approve/' . $data['no_cs']); ?>" class="btn btn-success"
                                    data-bs-toggle-tooltip="tooltip" title="Setujui"
                                    onclick="return confirm('Setujui data ini?')">
                                    <i class="fas fa-check"></i>
                                </a>

                                <!-- Revisi -->
                                <button class="btn btn-warning text-white" title="Revisi Data" data-bs-toggle="modal"
                                    data-bs-toggle-tooltip="tooltip" data-bs-target="#revisionModal_<?= $data['no_cs']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Reject -->
                                <button class="btn btn-danger" title="Tolak Data" data-bs-toggle="modal"
                                    data-bs-toggle-tooltip="tooltip" data-bs-target="#rejectModal_<?= $data['no_cs']; ?>">
                                    <i class="fas fa-times-circle"></i>
                                </button>

                            </div>
                        </td>

                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ===================== MODAL SECTION ======================== -->
<?php foreach ($pending as $data): ?>
    <!-- DETAIL MODAL -->
    <div class="modal fade" id="detailModal_<?= $data['no_cs']; ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="fas fa-info-circle me-2"></i>Detail Uang
                        Jalan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                            <p><strong>Jumlah Ritase:</strong> <?= $data['ritase']; ?></p>
                            <?php
                            $alasan = trim($data['alasan'] ?? '');
                            ?>
                            <?php
                            $no_surat_jalan = trim($data['no_surat_jalan'] ?? '');
                            ?>
                            <p><strong>No Surat Jalan:</strong>
                                <?= $no_surat_jalan !== '' ? $no_surat_jalan : '-' ?>
                            </p>
                            <p><strong>Alasan Additional:</strong>
                                <?= $alasan !== '' ? $alasan : '-' ?>
                            </p>

                            <?php
                            $jumlah = trim($data['jumlah'] ?? '');
                            ?>
                            <p>
                                <strong>Jumlah Additional (Rp):</strong> Rp.
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
                            <p><strong>Catatan:</strong> <?= trim($data['catatan'] ?? '') ?: '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- REVISION MODAL -->
    <div class="modal fade" id="revisionModal_<?= $data['no_cs']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">

                <form action="<?= base_url('approval/revision'); ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <!-- HEADER REVISI -->
                    <div class="modal-header bg-orange text-white rounded-top-4">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-edit me-2"></i> Revisi Data
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <input type="hidden" name="no_cs" value="<?= $data['no_cs']; ?>">
                        <label class="form-label fw-semibold">Alasan Revisi <span class="text-danger">*</span></label>
                        <textarea name="catatan" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer bg-white">
                        <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-orange rounded-pill" type="submit">Revisi</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- REJECT MODAL -->
    <div class="modal fade" id="rejectModal_<?= $data['no_cs']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">

                <form action="<?= base_url('approval/reject'); ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-header bg-danger text-white rounded-top-4">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-times-circle me-2"></i> Tolak Data
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <input type="hidden" name="no_cs" value="<?= $data['no_cs']; ?>">
                        <label class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="catatan" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="modal-footer bg-white">
                        <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-danger rounded-pill" type="submit">Tolak</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- ===== JS Plugins ===== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- ===== Styling Modern & Responsif ===== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    .table thead th {
        font-weight: 700;
        background-color: #007bff;
        color: #fff;
        vertical-align: middle;
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

    /* ===== TABLE CORE ===== */
    #uangJalanTable {
        table-layout: fixed;
        width: 100%;
    }


    #uangJalanTable tbody tr:hover td {
        color: #0d6efd;
    }

    .table tbody tr:hover {
        background-color: #f0f8ff;
        transition: 0.2s;
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

        /* table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #007bff;
        } */
    }

    .bg-orange {
        background-color: #fd7e14 !important;
    }

    .btn-orange {
        background-color: #fd7e14 !important;
        color: #fff !important;
    }

    .btn-orange:hover {
        background-color: #e56f10 !important;
        color: #fff !important;
    }

    /* ===== COLUMN WIDTH ===== */
    .col-id {
        width: 130px;
    }

    .col-date {
        width: 80px;
    }

    .col-unit {
        width: 90px;
    }

    .col-short {
        width: 80px;
    }

    .col-text {
        width: 130px;
    }

    .col-status {
        width: 70px;
    }

    .col-action {
        width: 150px;
    }
</style>

<!-- ====================== DATATABLE SCRIPT ====================== -->

<style>
    /* ===== SERAGAMKAN TEXT FILTER & SEARCH ===== */
    .card-body label,
    .dataTables_filter label,
    .dataTables_info {
        color: #212529 !important;
        /* text-dark Bootstrap */
        font-weight: 600;
    }
</style>

<script>
    $(document).ready(function () {

        const table = $('#uangJalanTable').DataTable({
            scrollX: true,
            autoWidth: false,
            language: {
                emptyTable: "Belum ada data yang perlu diapprove"
            },
            dom:
                "<'row mb-3'<'col-md-6'l><'col-md-6 text-end'f>>" +
                "rt" +
                "<'row'<'col-sm-12 col-md-5'i>" +
                "<'col-sm-12 col-md-7'p>>",
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: []
        });


        // ================= CUSTOM FILTER FIX =====================
        $.fn.dataTable.ext.search.push(function (settings, data) {

            const fTanggal = $('#filterTanggal').val();
            const fNocs = $('#filterNocs').val().toLowerCase();
            const fNounit = $('#filterNounit').val().toLowerCase();

            const rowNocs = data[0].toLowerCase();     // kolom 0 = No CS
            const rowTanggal = data[1];                // kolom 1 = Tanggal dd-mm-YYYY
            const rowNounit = data[2].toLowerCase();   // kolom 2 = No Unit

            // === Filter Tanggal ===
            if (fTanggal) {
                const conv = fTanggal.split('-').reverse().join('-'); // dd-mm-YYYY
                if (!rowTanggal.includes(conv)) return false;
            }

            // === Filter NO CS ===
            if (fNocs && !rowNocs.includes(fNocs)) return false;

            // === Filter NO UNIT ===
            if (fNounit && !rowNounit.includes(fNounit)) return false;

            return true;
        });

        $('#filterTanggal, #filterNocs, #filterNounit').on('keyup change', function () {
            table.draw();
        });

        $('#resetFilter').on('click', function () {
            $('#filterTanggal, #filterNocs, #filterNounit').val('');
            table.draw();
        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // INIT TOOLTIP (KHUSUS)
        const tooltipElements = document.querySelectorAll('[data-bs-toggle-tooltip="tooltip"]');
        const tooltips = [...tooltipElements].map(el =>
            new bootstrap.Tooltip(el, {
                trigger: 'hover'
            })
        );

        // 🔥 FIX UTAMA: HIDE TOOLTIP SAAT BUTTON DI-KLIK
        tooltipElements.forEach(el => {
            el.addEventListener('click', function () {
                const tooltip = bootstrap.Tooltip.getInstance(el);
                if (tooltip) tooltip.hide();
            });
        });

        // 🔥 SAFETY NET: HIDE SAAT MODAL TUTUP
        document.addEventListener('hidden.bs.modal', function () {
            tooltips.forEach(t => t.hide());
        });

    });
</script>
<!-- <?php if ($this->session->flashdata('pesan')): ?>
    <div class="mt-2">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
<?php endif; ?> -->

<div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
    <div class="card-header text-white py-3" style="background: linear-gradient(90deg, #0056b3, #007bff);">
        <h4 class="m-0 fw-bold">
            <i class="fas fa-money-check-alt me-2"></i> Partial Payment
        </h4>
    </div>

    <div class="card-body bg-light">

        <!-- FILTER -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="fw-semibold">Filter Tanggal</label>
                <input type="date" id="filterTanggal" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="fw-semibold">Filter No CS</label>
                <input type="text" id="filterNocs" class="form-control" placeholder="No CS">
            </div>
            <div class="col-md-3">
                <label class="fw-semibold">Filter No Unit</label>
                <input type="text" id="filterNounit" class="form-control" placeholder="No Unit">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button id="resetFilter" class="btn btn-secondary w-100">
                    <i class="fa fa-undo me-1"></i> Reset Filter
                </button>
            </div>
        </div>

        <label class="select-all mb-2">
            <input type="checkbox" id="selectAll">
            <span>Pilih Semua Data</span>
        </label>

        <!-- TABLE -->
        <table class="table table-hover align-middle text-dark w-100 table-fixed" id="uangJalanTable">
            <thead class="table-primary text-center text-nowrap">
                <tr>
                    <th class='text-center'></th>
                    <th class="text-center col-id">No CS</th>
                    <th class="text-center col-date">Tanggal</th>
                    <th class="text-center col-unit">No Unit</th>
                    <th class="text-center col-text">Driver</th>
                    <th class="text-center col-short">Cargo</th>
                    <th class="text-center col-text">Origin</th>
                    <th class="text-center col-text">Destination</th>
                    <th class="text-center col-action">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unpaid as $d): ?>
                    <tr class="data-row">
                        <td class="text-center">
                            <input type="checkbox" class="row-check" value="<?= $d['no_cs']; ?>">
                        </td>
                        <td><?= $d['no_cs']; ?></td>
                        <td><?= date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                        <td><?= $d['no_unit']; ?></td>
                        <td><?= $d['driver']; ?></td>
                        <td><?= $d['cargo']; ?></td>
                        <td><?= $d['origin']; ?></td>
                        <td><?= $d['destination']; ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal_<?= $d['no_cs']; ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <!-- FORM -->
        <form id="ProcessForm" action="<?= base_url('payment/process'); ?>" method="POST" target="downloadFrame">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="selectedData" id="selectedData">

            <div class="payment-footer">
                <button type="submit" class="btn btn-success px-4" id="btnProses">
                    <i class="fas fa-share-square me-2"></i>Lanjutkan Proses
                </button>
            </div>
        </form>

        <iframe name="downloadFrame" style="display:none;"></iframe>
    </div>
</div>

<!-- ================= MODAL (DI LUAR TABLE) ================= -->
<?php foreach ($unpaid as $d): ?>
    <div class="modal fade" id="detailModal_<?= $d['no_cs']; ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Detail Uang Jalan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>No CS:</strong> <?= $d['no_cs']; ?></p>
                            <p><strong>Tanggal:</strong>
                                <?= date('d-m-Y', strtotime($d['tanggal'])); ?></p>
                            <p><strong>Tipe Pekerjaan:</strong> <?= $d['tipe_pekerjaan']; ?></p>
                            <?php
                            $vesel = trim($d['vesel'] ?? '');
                            ?>
                            <p><strong>Vesel:</strong> <?= $vesel !== '' ? $vesel : '-' ?></p>
                            <p><strong>No Unit:</strong> <?= $d['no_unit']; ?></p>
                            <p><strong>Tipe Angkutan:</strong> <?= $d['tipe_angkutan']; ?></p>
                            <p><strong>Driver:</strong> <?= $d['driver']; ?></p>
                            <p><strong>Nomor Rekening Driver:</strong> <?= $d['nomor_rekening']; ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Cargo:</strong> <?= $d['cargo']; ?></p>
                            <p><strong>Tonase:</strong> <?= number_format($d['tonase'], 2); ?></p>
                            <p><strong>Origin:</strong> <?= $d['origin']; ?></p>
                            <p><strong>Destination:</strong> <?= $d['destination']; ?></p>
                            <p><strong>Ritase:</strong> <?= $d['ritase']; ?></p>
                            <?php
                            $alasan = trim($d['alasan'] ?? '');
                            ?>
                            <?php
                            $no_surat_jalan = trim($d['no_surat_jalan'] ?? '');
                            ?>
                            <p><strong>No Surat Jalan:</strong>
                                <?= $no_surat_jalan !== '' ? $no_surat_jalan : '-' ?>
                            <p><strong>Alasan Additional:</strong> <?= $alasan !== '' ? $alasan : '-' ?>
                            </p>
                            <?php
                            $jumlah = trim($d['jumlah'] ?? '');
                            ?>
                            <p>
                                <strong>Jumlah Additional (Rp):</strong>Rp.
                                <?= $jumlah !== '' ? number_format($jumlah, 0, ',', '.') : '-' ?>
                            </p>
                            <p>
                                <strong> Total UJO (Rp):</strong>
                                <span class="text-primary fw-semibold">
                                    Rp.<?= number_format($d['ujo'], 0, ',', '.'); ?>
                                </span>
                            </p>
                            <p>
                                <strong> UJO Terbayar (Rp):</strong>
                                <span class="text-success fw-semibold">
                                    Rp.<?= number_format($d['ujo_terbayar'], 0, ',', '.'); ?>
                                </span>
                            </p>
                            <p>
                                <strong> Sisa UJO (Rp):</strong>
                                <span class="text-danger fw-semibold">
                                    Rp.<?= number_format($d['ujo_sisa'], 0, ',', '.'); ?>
                                </span>
                            </p>
                            <p><strong>Catatan:</strong> <?= trim($d['catatan'] ?? '') ?: '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
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
    .table-fixed {
        table-layout: fixed;
        width: 100%;
    }

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
        background-color: #f0f8ff;
        transition: 0.2s;
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

    /* ===== COLUMN WIDTH ===== */
    .col-id {
        width: 120px;
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
        width: 150px;
    }

    .col-action {
        min-width: 70px;
        width: 70px;
    }
</style>

<!-- ====================== DATATABLE SCRIPT ====================== -->

<style>
    .dt-buttons .btn {
        margin-right: 8px !important;
    }

    .payment-footer {
        position: sticky;
        bottom: 0;
        right: 0;
        background: #ffffff;
        padding: 15px 20px;
        border-top: 1px solid #dee2e6;
        display: flex;
        justify-content: flex-end;
        z-index: 20;
    }

    .form-check-label {
        cursor: pointer;
        user-select: none;
    }

    tr.row-selected {
        background-color: #e9f2ff !important;
    }

    /* ===== FIX SELECT ALL (PRESISI 100%) ===== */
    .select-all {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
    }

    .select-all input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin: 0;
        transform: scale(1.2);
        cursor: pointer;
    }

    .select-all span {
        line-height: 2;
    }

    td .row-check {
        transform: scale(1.1);
        margin: 0;
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

<script>

    // =======================================================
    //  GLOBAL DATATABLE
    // =======================================================
    var table;

    $(document).ready(function () {

        // INIT DATATABLE
        table = $('#uangJalanTable').DataTable({
            scrollX: true,
            autoWidth: false,
            responsive: false,
            language: {
                emptyTable: "Belum ada data yang perlu dilakukan pembayaran parsial"
            },
            dom: 't',
            pageLength: 10,
            order: []
        });

        // CUSTOM FILTER
        $.fn.dataTable.ext.search.push(function (settings, data) {

            const fTanggal = $('#filterTanggal').val();
            const fNocs = $('#filterNocs').val().toLowerCase();
            const fNounit = $('#filterNounit').val().toLowerCase();

            const rowNocs = data[1].toLowerCase();
            const rowTanggal = data[2];
            const rowNounit = data[3].toLowerCase();

            if (fTanggal) {
                const convDate = fTanggal.split('-').reverse().join('-');
                if (!rowTanggal.includes(convDate)) return false;
            }

            if (fNocs && !rowNocs.includes(fNocs)) return false;
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

    // =======================================================
    //  CLICK ROW = TOGGLE CHECKBOX
    // =======================================================
    $(document).on("click", "#uangJalanTable tbody tr", function (e) {

        // Abaikan klik checkbox / button / icon / link
        if (
            $(e.target).is("input, button, i, a") ||
            $(e.target).closest("button, a").length
        ) {
            return;
        }

        let checkbox = $(this).find(".row-check");
        checkbox.prop("checked", !checkbox.prop("checked")).trigger("change");
    });

    // =======================================================
    //  CHECKBOX CHANGE = HIGHLIGHT + SELECT ALL
    // =======================================================
    $(document).on("change", ".row-check", function () {
        $(this).closest("tr").toggleClass("row-selected", this.checked);

        let total = $(".row-check").length;
        let checked = $(".row-check:checked").length;
        $("#selectAll").prop("checked", total === checked);
    });

    // =======================================================
    //  SELECT ALL
    // =======================================================
    $("#selectAll").on("change", function () {
        $(".row-check").prop("checked", this.checked).trigger("change");
    });

    // =======================================================
    //  SUBMIT FORM
    // =======================================================
    document.getElementById("ProcessForm").addEventListener("submit", function (e) {

        let checked = document.querySelectorAll(".row-check:checked");

        if (checked.length === 0) {
            alert("Tidak ada data yang dipilih!");
            e.preventDefault();
            return false;
        }

        let selected = [];
        checked.forEach(c => selected.push(c.value));
        document.getElementById("selectedData").value = JSON.stringify(selected);

        // disable tombol
        let btn = document.getElementById("btnProses");
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Memproses...';

        setTimeout(() => location.reload(), 500);
    });

</script>
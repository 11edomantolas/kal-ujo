<!-- <?php if ($this->session->flashdata('pesan')): ?>
    <div class="mt-2">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
<?php endif; ?> -->

<div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
    <div class="card-header text-white py-3" style="background: linear-gradient(90deg, #0056b3, #007bff);">
        <h4 class="m-0 fw-bold">
            <i class="fas fa-money-check-alt me-2"></i> Settlement Pekerjaan
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
                <label class="fw-semibold text-dark">Filter Driver</label>
                <input type="text" id="filterDriver" class="form-control" placeholder="Nama Driver">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button id="resetFilter" class="btn btn-secondary w-100">
                    <i class="fa fa-undo me-1"></i> Reset Filter
                </button>
            </div>
        </div>

        <!-- ====================== TABEL ============================= -->
        <div class="table-responsive">
            <table class="table table-hover align-middle text-dark" id="uangJalanTable">
                <thead class="table-primary">
                    <tr>
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
                    <?php foreach ($process as $no_cs => $items): ?>
                        <?php $d = $items[0]; ?>
                        <tr class="toggle-detail" data-target="#detail-<?= $no_cs ?>" style="cursor:pointer;">
                            <td class="text-left fw-semibold">
                                <?= $no_cs ?>
                            </td>
                            <td class="text-center">
                                <?= date('d-m-Y', strtotime($d['tanggal'])) ?>
                            </td>
                            <td class="text-center">
                                <?= $d['no_unit'] ?>
                            </td>

                            <td class="text-start truncate-text col-text" title="<?= htmlspecialchars($d['driver']) ?>">
                                <?= $d['driver'] ?>
                            </td>
                            <td class="text-center">
                                <?= $d['cargo'] ?>
                            </td>
                            <td class="text-start truncate-text col-text" title="<?= htmlspecialchars($d['origin']) ?>">
                                <?= $d['origin'] ?>
                            </td>

                            <td class="text-start truncate-text col-text"
                                title="<?= htmlspecialchars($d['destination']) ?>">
                                <?= $d['destination'] ?>
                            </td>

                            <td class="text-center text-nowrap">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#detailModal_<?= $no_cs ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>


                        <!-- ================== BREAKDOWN RIT ================== -->
                        <tr>
                            <td colspan="8" class="p-0">
                                <div class="collapse breakdown-container" id="detail-<?= $no_cs ?>">
                                    <div class="breakdown-section-header">
                                        <i class="fas fa-tasks me-2"></i> Detail & Settlement Pekerjaan
                                    </div>
                                    <table class="table table-breakdown mb-0">
                                        <thead>
                                            <tr>
                                                <th class="bd-rit">Rit</th>
                                                <th class="bd-ujo">UJO</th>
                                                <th class="bd-bayar">Terbayar</th>
                                                <th class="bd-sisa">Sisa</th>

                                                <!-- AREA KERJA -->
                                                <th class="bd-input">Input Surat Jalan</th>
                                                <th class="bd-input">Tonase Aktual</th>

                                                <th class="bd-aksi text-center">Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($items as $rit): ?>
                                                <tr class="rit-row <?= $rit['status_pekerjaan'] === 'Completed' ? 'completed' : 'uncompleted' ?>"
                                                    data-id="<?= $rit['id']; ?>">

                                                    <!-- RIT -->
                                                    <td class="bd-rit fw-semibold">
                                                        Rit <?= $rit['rit_ke']; ?>
                                                    </td>

                                                    <!-- DATA KEUANGAN -->
                                                    <td class="bd-ujo">
                                                        Rp <?= number_format($rit['ujo'], 0, ',', '.'); ?>
                                                    </td>

                                                    <td class="bd-bayar text-success">
                                                        Rp <?= number_format($rit['ujo_terbayar'], 0, ',', '.'); ?>
                                                    </td>

                                                    <td class="bd-sisa text-danger">
                                                        Rp <?= number_format($rit['ujo_sisa'], 0, ',', '.'); ?>
                                                    </td>

                                                    <!-- INPUT SURAT JALAN -->
                                                    <td class="bd-input">
                                                        <label class="input-label">No Surat Jalan</label>
                                                        <input type="text" class="form-control form-control-sm sj-input"
                                                            value="<?= $rit['no_surat_jalan'] ?? '' ?>"
                                                            <?= $rit['status_pekerjaan'] === 'Completed' ? 'readonly' : '' ?>>
                                                    </td>

                                                    <!-- INPUT TONASE -->
                                                    <td class="bd-input">
                                                        <label class="input-label">Tonase Aktual (Ton)</label>
                                                        <input type="number" step="0.01"
                                                            class="form-control form-control-sm tonase-input" value="<?= (!empty($rit['tonase']) && $rit['tonase'] != 0)
                                                                ? rtrim(rtrim((float) $rit['tonase'], '0'), '.')
                                                                : '' ?>" <?= $rit['status_pekerjaan'] === 'Completed' ? 'readonly' : '' ?>>
                                                    </td>

                                                    <!-- AKSI -->
                                                    <td class="bd-aksi text-center align-middle">
                                                        <?php if ($rit['status_pekerjaan'] === 'Uncompleted'): ?>
                                                            <form method="post"
                                                                action="<?= base_url('payment/konfirmasi_rit/' . $rit['id']); ?>"
                                                                class="confirm-form">

                                                                <input type="hidden"
                                                                    name="<?= $this->security->get_csrf_token_name(); ?>"
                                                                    value="<?= $this->security->get_csrf_hash(); ?>">

                                                                <input type="hidden" name="no_surat_jalan" class="sj-hidden">
                                                                <input type="hidden" name="tonase" class="tonase-hidden">

                                                                <button type="submit" class="btn btn-success btn-sm btn-confirm"
                                                                    disabled title="Lengkapi Surat Jalan & Tonase">
                                                                    <i class="fas fa-check me-1"></i> Settlement
                                                                </button>
                                                            </form>
                                                        <?php else: ?>
                                                            <span class="badge bg-success px-3 py-2">
                                                                <i class="fas fa-check-circle me-1"></i> Completed
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ===================== MODAL SECTION ======================== -->
<?php foreach ($process as $no_cs => $items): ?>
    <?php $d = $items[0]; ?>

    <div class="modal fade" id="detailModal_<?= $no_cs ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i> Detail Uang Jalan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>No CS:</strong>
                                <?= $no_cs ?>
                            </p>
                            <p><strong>Tanggal:</strong>
                                <?= date('d-m-Y', strtotime($d['tanggal'])); ?>
                            </p>
                            <p><strong>Driver:</strong>
                                <?= $d['driver']; ?>
                            </p>
                            <p><strong>No Unit:</strong>
                                <?= $d['no_unit']; ?>
                            </p>
                            <p><strong>Vesel:</strong>
                                <?= $d['vesel'] ?: '-' ?>
                            </p>
                            <p><strong>Tipe Angkutan:</strong>
                                <?= $d['tipe_angkutan']; ?>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Cargo:</strong>
                                <?= $d['cargo']; ?>
                            </p>
                            <p><strong>Origin:</strong>
                                <?= $d['origin']; ?>
                            </p>
                            <p><strong>Destination:</strong>
                                <?= $d['destination']; ?>
                            </p>
                            <p><strong>Jumlah Ritase:</strong>
                                <?= $d['ritase']; ?>
                            </p>
                            <p>
                                <strong>Total UJO:</strong>
                                <span class="text-primary fw-semibold">
                                    Rp
                                    <?= number_format(array_sum(array_column($items, 'ujo')), 0, ',', '.'); ?>
                                </span>
                            </p>
                            <p>
                                <strong>Total UJO Terbayar:</strong>
                                <span class="text-success fw-semibold">
                                    Rp
                                    <?= number_format(array_sum(array_column($items, 'ujo_terbayar')), 0, ',', '.'); ?>
                                </span>
                            </p>
                            <p>
                                <strong>Total Sisa:</strong>
                                <span class="text-danger fw-semibold">
                                    Rp
                                    <?= number_format(array_sum(array_column($items, 'ujo_sisa')), 0, ',', '.'); ?>
                                </span>
                            </p>
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
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css"> -->

<style>
    #uangJalanTable thead th {
        font-weight: 700;
        background-color: #007bff;
        color: #fff;
    }

    #uangJalanTable tbody td {
        color: #212529;
        padding: 4px 8px;
        line-height: 2;
        vertical-align: middle;
    }

    #uangJalanTable tbody tr:hover td {
        color: #0d6efd;
    }

    .dataTables_wrapper .dt-buttons {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        #uangJalanTable thead {
            display: none;
        }

        #uangJalanTable tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
        }

        #uangJalanTable tbody td {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            padding: 5px 0;
        }

        #uangJalanTable tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #007bff;
        }
    }

    /* HEADER tabel utama */
    #uangJalanTable>thead>tr>th {
        font-size: 15px;
    }

    /* BODY tabel utama */
    #uangJalanTable>tbody>tr>td {
        font-size: 15px;
    }

    /* ===== TABLE CORE ===== */
    #uangJalanTable {
        table-layout: fixed;
        width: 100%;
    }

    /* ===== COLUMN WIDTH ===== */
    .col-id {
        width: 140px;
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

    .col-action {
        width: 85px;
    }

    /* ===== TEXT WRAP KHUSUS TEKS PANJANG ===== */
    .wrap-text {
        white-space: normal;
        word-break: break-word;
        line-height: 1.3;
    }

    /* ===== HEADER ===== */
    #uangJalanTable thead th {
        font-weight: 700;
        color: #fff;
        background: #007bff;
    }

    /* ===== HOVER ===== */
    #uangJalanTable tbody tr:hover {
        background-color: #f0f8ff;
    }


    /* ===== BUTTON ===== */
    .btn-group .btn {
        margin-right: 4px;
    }


    /* Header kolom teks panjang */
    #uangJalanTable thead th.text-start {
        text-align: left !important;
    }


    /* ===== SERAGAMKAN TEXT FILTER & SEARCH ===== */
    .card-body label,
    .dataTables_filter label,
    .dataTables_info {
        color: #212529 !important;
        /* text-dark Bootstrap */
        font-weight: 600;
    }

    /* ===== POTONG TEKS PANJANG (TABEL UTAMA) ===== */
    .truncate-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* KUNCI LEBAR AGAR 1 LAYAR */
    .col-text {
        max-width: 130px;
    }

    /* ===== BREAKDOWN RIT ===== */
    .table-breakdown {
        table-layout: fixed;
        width: 100%;
    }

    /* WIDTH PER KOLOM */
    .bd-rit {
        width: 70px;
    }

    .bd-sj {
        width: 140px;
    }

    .bd-tonase {
        width: 90px;
    }

    .bd-ujo {
        width: 110px;
        text-align: left;
    }

    .bd-bayar {
        width: 110px;
        text-align: left;
    }

    .bd-sisa {
        width: 110px;
        text-align: left;
    }

    .bd-aksi {
        width: 100px;
    }

    /* POTONG TEKS SURAT JALAN */
    .bd-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table-breakdown input {
        font-size: 13px;
        padding: 4px 6px;
        height: 30px;
    }

    .btn-konfirmasi {
        padding: 4px 10px;
    }

    .rit-row.saving {
        opacity: 0.6;
        pointer-events: none;
    }

    /* ===== ENTERPRISE BREAKDOWN UX ===== */

    .table-breakdown {
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    /* BODY */
    .table-breakdown tbody td {
        font-size: 14px;
    }

    .table-breakdown thead th {
        background: #f1f3f5 !important;
        color: #6c757d !important;
        font-size: 14px;
        font-weight: 700;
    }

    .rit-row {
        background: #ffffff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        border-radius: 8px;
    }

    .rit-row.uncompleted {
        border-left: 4px solid #fd7e14;
    }

    .rit-row.completed {
        opacity: 0.75;
        background: #f8f9fa;
    }

    .bd-input {
        background: #f8f9fa;
    }

    .input-label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .bd-input input {
        border: 1px solid #ced4da;
    }

    .bd-input input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.1rem rgba(13, 110, 253, .15);
    }

    .btn-confirm {
        min-width: 110px;
        font-weight: 600;
    }

    .breakdown-section-header {
        background: #e9ecef;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 700;
        color: #495057;
        border-left: 4px solid #fd7e14;
    }

    .breakdown-container {
        background: #f8f9fa;
        padding: 10px;
    }
</style>

<!-- ====================== DATATABLE SCRIPT ====================== -->

<style>
    .dataTables_wrapper .dt-buttons {
        margin-bottom: 15px !important;
    }

    .dt-buttons .btn {
        margin-right: 8px !important;
    }
</style>

<script>
    $(document).ready(function () {

        const table = $('#uangJalanTable').DataTable({
            scrollX: false,
            autoWidth: false,
            responsive: true,
            language: {
                emptyTable: "Belum ada data yang perlu dikonfirmasi"
            },
            dom:
                "<'row mb-3'<'col-md-6'><'col-md-6 text-end'f>>" +
                "rt" +
                "<'row'<'col-sm-12 col-md-5'i>" +
                "<'col-sm-12 col-md-7'p>>",
            pageLength: 10,
            order: []
        });
    });
</script>
<script>
    $(document).ready(function () {

        function applyFilter() {
            const fTanggal = $('#filterTanggal').val();
            const fNocs = $('#filterNocs').val().toLowerCase();
            const fDriver = $('#filterDriver').val().toLowerCase();

            $('#uangJalanTable tbody tr.toggle-detail').each(function () {

                const row = $(this);

                const rowNocs = row.find('td:eq(0)').text().toLowerCase();
                const rowTanggal = row.find('td:eq(1)').text();
                const rowDriver = row.find('td:eq(3)').text().toLowerCase();

                let show = true;

                if (fTanggal) {
                    const conv = fTanggal.split('-').reverse().join('-');
                    if (!rowTanggal.includes(conv)) show = false;
                }

                if (fNocs && !rowNocs.includes(fNocs)) show = false;
                if (fDriver && !rowDriver.includes(fDriver)) show = false;

                row.toggle(show);
                row.next('tr').toggle(show); // sembunyikan breakdown
            });
        }

        $('#filterTanggal, #filterNocs, #filterDriver')
            .on('keyup change', applyFilter);

        $('#resetFilter').on('click', function () {
            $('#filterTanggal, #filterNocs, #filterDriver').val('');
            applyFilter();
        });

    });
</script>

<script>
    $(document).ready(function () {

        // Toggle breakdown saat klik baris
        $('#uangJalanTable tbody').on('click', 'tr.toggle-detail', function (e) {

            // cegah klik tombol / link ikut trigger
            if ($(e.target).closest('button, a').length) return;

            const target = $(this).data('target');
            $(target).collapse('toggle');
        });

    });
</script>

<script>
    $(document).on('submit', 'form', function () {
        const row = $(this).closest('tr');

        const noSj = row.find('.sj-input').val();
        const tonase = row.find('.tonase-input').val();

        if (!noSj || !tonase) {
            alert('No Surat Jalan dan Tonase wajib diisi');
            return false;
        }

        $(this).find('.sj-hidden').val(noSj);
        $(this).find('.tonase-hidden').val(tonase);

        return true; // lanjut submit + refresh
    });

    $(document).on('input', '.sj-input, .tonase-input', function () {
        const row = $(this).closest('tr');
        const sj = row.find('.sj-input').val().trim();
        const tonase = row.find('.tonase-input').val().trim();
        const btn = row.find('.btn-confirm');

        if (sj && tonase) {
            btn.prop('disabled', false);
            row.addClass('ready');
        } else {
            btn.prop('disabled', true);
            row.removeClass('ready');
        }
    });
</script>
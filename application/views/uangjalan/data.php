<!-- <?= $this->session->flashdata('pesan'); ?> -->

<div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
    <div class="card-header text-white py-3" style="background: linear-gradient(90deg, #0056b3, #007bff);">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h4 class="m-0 fw-bold"><i class="fas fa-money-check-alt me-2"></i> Data Uang Jalan</h4>
            <a href="<?= base_url('uangjalan/create') ?>"
                class="btn btn-light btn-sm rounded-pill shadow-sm fw-semibold mt-2 mt-md-0">
                <i class="fa fa-plus me-1"></i> Tambah Data
            </a>
        </div>
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
                <label class="fw-semibold text-dark">Filter Status</label>
                <input type="text" id="filterStatus" class="form-control" placeholder="Status">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button id="resetFilter" class="btn btn-secondary w-100">
                    <i class="fa fa-undo me-1"></i> Reset Filter
                </button>
            </div>
        </div>
        <!-- 📊 Tabel -->
        <table class="table table-hover align-middle text-dark w-100" id="uangJalanTable">
            <thead class="table-primary text-center text-nowrap">
                <tr class="text-center">
                    <!-- <th>No</th> -->
                    <th class='text-center'>No CS</th>
                    <th class='text-center'>Tanggal</th>
                    <th class='text-center'>No Unit</th>
                    <th class='text-center'>Driver</th>
                    <th class='text-center' style="display:none;">Status Order</th>
                    <th class='text-center'>Status</th>
                    <th class='text-center'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($uang_jalan)):
                    $no = 1;
                    foreach ($uang_jalan as $data): ?>
                        <tr>
                            <!-- <td class="text-center"><?= $no++; ?></td> -->
                            <td>
                                <?= $data['no_cs']; ?>
                            </td>
                            <td>
                                <?= date('d-m-Y', strtotime($data['tanggal'])); ?>
                            </td>
                            <td>
                                <?= $data['no_unit']; ?>
                            </td>
                            <td>
                                <?= $data['driver']; ?>
                            </td>
                            <!-- kolom status helper untuk sorting -->
                            <?php
                            switch (strtolower($data['status'])) {
                                case 'pending':
                                    $status_order = 1;
                                    break;
                                case 'revision':
                                    $status_order = 2;
                                    break;
                                case 'approved':
                                    $status_order = 3;
                                    break;
                                case 'rejected':
                                    $status_order = 4;
                                    break;
                                default:
                                    $status_order = 5;
                            }
                            ?>
                            <td style="display:none;">
                                <?= $status_order ?>
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
                                <span class="badge <?= $badgeClass ?>">
                                    <?= $data['status']; ?>
                                </span>
                            </td>

                            <?php
                            $status = strtolower($data['status']);
                            $editable = in_array($status, ['revision', 'pending']);
                            $deletetable = in_array($status, ['pending']);

                            ?>

                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <!-- Detail -->
                                    <button type="button" title="Lihat Detail" data-bs-toggle-tooltip="tooltip"
                                        class="btn btn-info text-white" data-bs-toggle="modal"
                                        data-bs-target="#detailModal<?= $data['id']; ?>">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <!-- Edit -->
                                    <a href="<?= base_url('uangjalan/edit_cs/') . $data['no_cs'] ?>"
                                        class="btn btn-warning text-white" title="Edit Data" data-bs-toggle-tooltip="tooltip">
                                        <i class="fa fa-edit" title="Edit Data"></i>
                                    </a>
                                    <!-- Delete -->
                                    <a href="<?= $deletetable ? base_url('uangjalan/delete/') . $data['id'] : 'javascript:void(0)' ?>"
                                        data-bs-toggle-tooltip="tooltip" title="Hapus Data"
                                        class="btn btn-danger <?= $deletetable ? '' : 'disabled' ?>" <?= $deletetable ? '' : 'style="opacity: 0.5; cursor:not-allowed;"' ?>         <?= $deletetable ? 'onclick="return confirm(\'Yakin ingin menghapus data ini?\')"' : '' ?>>
                                        <i class="fa fa-trash" title="Hapus Data"></i>
                                    </a>
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
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-light">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>No CS:</strong>
                                                    <?= $data['no_cs']; ?>
                                                </p>
                                                <p><strong>Tanggal:</strong>
                                                    <?= date('d-m-Y', strtotime($data['tanggal'])); ?>
                                                </p>
                                                <p><strong>Tipe Pekerjaan:</strong>
                                                    <?= $data['tipe_pekerjaan']; ?>
                                                </p>
                                                <?php
                                                $vesel = trim($data['vesel'] ?? '');
                                                ?>
                                                <p><strong>Vesel:</strong>
                                                    <?= $vesel !== '' ? $vesel : '-' ?>
                                                </p>
                                                <p><strong>No Unit:</strong>
                                                    <?= $data['no_unit']; ?>
                                                </p>
                                                <p><strong>Tipe Angkutan:</strong>
                                                    <?= $data['tipe_angkutan']; ?>
                                                </p>
                                                <p><strong>Driver:</strong>
                                                    <?= $data['driver']; ?>
                                                </p>
                                                <p><strong>Nomor Rekening Driver:</strong>
                                                    <?= $data['nomor_rekening']; ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Cargo:</strong>
                                                    <?= $data['cargo']; ?>
                                                </p>
                                                <p><strong>Origin:</strong>
                                                    <?= $data['origin']; ?>
                                                </p>
                                                <p><strong>Destination:</strong>
                                                    <?= $data['destination']; ?>
                                                </p>
                                                <p><strong>Jumlah Ritase:</strong>
                                                    <?= $data['ritase']; ?>
                                                </p>
                                                <?php
                                                $alasan = trim($data['alasan'] ?? '');
                                                ?>
                                                <?php
                                                $no_surat_jalan = trim($data['no_surat_jalan'] ?? '');
                                                ?>
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
                                                        Rp.
                                                        <?= number_format($data['ujo'], 0, ',', '.'); ?>
                                                    </span>
                                                </p>
                                                <p>
                                                    <strong> UJO Terbayar (Rp):</strong>
                                                    <span class="text-success fw-semibold">
                                                        Rp.
                                                        <?= number_format($data['ujo_terbayar'], 0, ',', '.'); ?>
                                                    </span>
                                                </p>
                                                <p>
                                                    <strong> Sisa UJO (Rp):</strong>
                                                    <span class="text-danger fw-semibold">
                                                        Rp.
                                                        <?= number_format($data['ujo_sisa'], 0, ',', '.'); ?>
                                                    </span>
                                                </p>
                                                <p><strong>Status:</strong>
                                                    <?= $data['status']; ?>
                                                </p>
                                                <p><strong>Catatan:</strong>
                                                    <?= trim($data['catatan'] ?? '') ?: '-' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-white">
                                        <button type="button" class="btn btn-secondary rounded-pill"
                                            data-bs-dismiss="modal">Tutup</button>
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
        background-color: #f0f8ff;
        transition: 0.2s;
    }

    .btn-group .btn {
        margin-right: 4px;
    }

    .bg-orange {
        background-color: #fd7e14 !important;
        /* Bootstrap Orange */

    }

    #uangJalanTable.dataTable thead th {
        text-align: center !important;
        white-space: nowrap;
    }

    /* ===== TABLE CORE ===== */
    #uangJalanTable {
        table-layout: fixed;
        width: 100%;
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
    const table = $('#uangJalanTable').DataTable({
        scrollX: true,
        autoWidth: false,
        language: {
            emptyTable: "Belum ada data uang jalan"
        },
        dom: "<'row mb-3'<'col-md-6'l><'col-md-6 text-end'f>>" +
            "rt" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        order: []
    });


    // ========================= CUSTOM FILTER ===============================
    $.fn.dataTable.ext.search.push(function (settings, data) {
        const fTanggal = $('#filterTanggal').val();     // YYYY-MM-DD
        const fNocs = $('#filterNocs').val().toLowerCase();
        const fStatus = $('#filterStatus').val().toLowerCase();

        const rowNocs = data[0].toLowerCase();          // No CS
        const rowTanggal = data[1];                     // Tanggal dd-mm-YYYY
        const rowStatus = data[6].toLowerCase();        // Status

        // === Filter Tanggal ===
        if (fTanggal) {
            const convDate = fTanggal.split('-').reverse().join('-'); // dd-mm-YYYY
            if (!rowTanggal.includes(convDate)) return false;
        }

        // === Filter No CS ===
        if (fNocs && !rowNocs.includes(fNocs)) return false;

        // === Filter Status ===
        if (fStatus && !rowStatus.includes(fStatus)) return false;

        return true;
    });


    $('#filterTanggal, #filterStatus, #filterNocs').on('keyup change', function () {
        table.draw();
    });

    $('#resetFilter').on('click', function () {
        $('#filterTanggal, #filterStatus, #filterNocs').val('');
        table.draw();
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
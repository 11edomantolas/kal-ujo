<!-- <?= $this->session->flashdata('pesan'); ?> -->
<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data User
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span class="text">
                        Tambah User
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped nowrap" id="dataTable">
            <thead>
                <tr>
                    <th width="40">No.</th>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Nama Pengguna</th>
                    <th>Email Perusahaan</th>
                    <th>Role</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <img src="<?= base_url('assets/img/avatar/' . $user['foto']) ?>" width="32"
                                class="rounded-circle border">
                        </td>

                        <td>
                            <?= $user['username']; ?>
                        </td>
                        <td>
                            <?= $user['nama']; ?>
                        </td>
                        <td>
                            <?= $user['email']; ?>
                        </td>
                        <td>
                            <?= ucwords(str_replace('_', ' ', $user['role'])); ?>
                        </td>


                        <!-- STATUS -->
                        <td class="text-center align-middle">
                            <span class="badge <?= $user['is_active'] ? 'badge-success' : 'badge-secondary' ?>">
                                <?= $user['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </td>

                        <!-- AKSI -->
                        <td class="text-center align-middle">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow-sm">
                                    <a class="dropdown-item" href="<?= base_url('user/edit/' . $user['id_user']) ?>">
                                        <i class="fa fa-edit mr-2 text-warning"></i>Edit
                                    </a>

                                    <a class="dropdown-item" href="<?= base_url('user/toggle/' . $user['id_user']) ?>">
                                        <i class="fa fa-power-off mr-2 text-secondary"></i>
                                        <?= $user['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-danger"
                                        onclick="return confirm('Yakin ingin menghapus user?')"
                                        href="<?= base_url('user/delete/' . $user['id_user']) ?>">
                                        <i class="fa fa-trash mr-2"></i>Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script>
    $('#dataTable').DataTable({
        scrollX: true,
        autoWidth: false,
        columnDefs: [
            { targets: -1, orderable: false, searchable: false }
        ]
    });
</script>


<style>
    #dataTable td {
        vertical-align: middle;
        font-size: 14px;
        padding: 6px 8px;
        white-space: nowrap;
    }

    .dropdown-menu {
        font-size: 14px;
    }

    .badge {
        padding: 6px 10px;
        font-weight: 500;
    }

    .dataTables_scrollBody {
        scrollbar-width: thin;
    }

    #dataTable th {
        font-size: 15px;
        font-weight: 700;
        white-space: nowrap;
    }
</style>
<div class="container">

    <!-- NAV TABS MASTER -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link <?= $active == 'bank' ? 'active' : '' ?>" href="<?= site_url('bank') ?>">Bank</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $active == 'tipe' ? 'active' : '' ?>" href="<?= site_url('tipe') ?>">Tipe
                Angkutan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active == 'cargo' ? 'active' : '' ?>" href="<?= site_url('cargo') ?>">Cargo
            </a>
        </li>
    </ul>

    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('cargo/add') ?>" class="btn btn-primary">Tambah Cargo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto; white-space: nowrap; max-width: 100%;">
                <table class="table table-striped table-bordered" id="dataTable"
                    style="width: 100%; table-layout: auto;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cargo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($cargo as $a): ?>
                            <tr>
                                <td><?= $no++ ?></td>

                                <td><?= $a['cargo'] ?></td>
                                <td>
                                    <a href="<?= site_url('cargo/edit/' . $a['id']) ?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= site_url('cargo/hapus/' . $a['id']) ?>" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        #dataTable td {
            padding: 4px;
            vertical-align: middle;
            font-size: 15px;
        }
    </style>
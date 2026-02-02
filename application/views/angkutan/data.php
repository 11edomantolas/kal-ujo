<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('angkutan/add') ?>" class="btn btn-primary">Tambah Angkutan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto; white-space: nowrap; max-width: 100%;">
                <table class="table table-striped table-bordered" id="dataTable"
                    style="width: 100%; table-layout: auto;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe</th>
                            <th>Nomor Polisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($angkutan as $a): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($a['tipe_angkutan'], ENT_QUOTES, 'UTF-8'); ?></td>

                                <td><?= $a['nomor_polisi'] ?></td>
                                <td>
                                    <a href="<?= site_url('angkutan/edit/' . $a['id']) ?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= site_url('angkutan/hapus/' . $a['id']) ?>" class="btn btn-sm btn-danger"
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
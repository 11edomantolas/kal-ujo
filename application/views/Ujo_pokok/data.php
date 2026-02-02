<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('ujo_pokok/add') ?>" class="btn btn-primary">Tambah Ujo Pokok</a>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto; white-space: nowrap; max-width: 100%;">
                <table class="table table-striped table-bordered" id="dataTable"
                    style="width: 100%; table-layout: auto;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Tipe</th>
                            <th>UJO Pokok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($Ujo_pokok)): ?>
                            <?php $no = 1;
                            foreach ($Ujo_pokok as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['origin'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($row['destination'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($row['tipe_angkutan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="text-end">
                                        Rp. <?= number_format($row['uang_jalan_pokok'], 0, ',', '.'); ?>
                                    </td>

                                    <td>
                                        <a href="<?= site_url('Ujo_pokok/edit/' . $row['id']) ?>"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= site_url('Ujo_pokok/hapus/' . $row['id']) ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
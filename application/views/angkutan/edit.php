<div class="container">
    <h2>Edit Angkutan</h2>
    <?= validation_errors(); ?>
    <?= form_open('angkutan/edit/' . $angkutan->id); ?>

    <div class="form-group">
        <label>Tipe</label>
        <select name="tipe_angkutan" class="form-control" required>
            <option value="" disabled selected>Pilih Tipe Angkutan</option>
            <?php foreach ($tipe_angkutan as $b): ?>
                <option value="<?= $b['nama_tipe'] ?>" <?= ($b['nama_tipe'] == $angkutan->tipe_angkutan) ? 'selected' : '' ?>>
                    <?= $b['nama_tipe'] ?>
                </option>
            <?php endforeach; ?>
        </select>

    </div>
    <div class="form-group">
        <label>Nomor Polisi</label>
        <input type="text" name="nomor_polisi" class="form-control" value="<?= $angkutan->nomor_polisi ?>">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= site_url('angkutan') ?>" class="btn btn-secondary">Kembali</a>

    <?= form_close(); ?>
</div>
<div class="container">
    <h2>Tambah Bank</h2>
    <?= validation_errors(); ?>
    <?= form_open('bank/add'); ?>

    <div class="form-group">
        <label>Kode Bank</label>
        <input type="number" name="kode_bank" class="form-control">
    </div>
    <div class="form-group">
        <label>Nama Bank</label>
        <input type="text" name="nama_bank" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('bank') ?>" class="btn btn-secondary">Kembali</a>

    <?= form_close(); ?>
</div>
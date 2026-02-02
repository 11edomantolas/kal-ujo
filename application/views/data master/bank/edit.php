<div class="container">
    <h2>Edit Bank</h2>
    <?= validation_errors(); ?>
    <?= form_open('bank/edit/' . $bank->id); ?>

    <div class="form-group">
        <label>Kode Bank</label>
        <input type="number" name="kode_bank" class="form-control" value="<?= $bank->kode_bank ?>">
    </div>



    <div class="form-group">
        <label>Nama Bank</label>
        <input type="text" name="nama_bank" class="form-control" value="<?= $bank->nama_bank ?>">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= site_url('bank') ?>" class="btn btn-secondary">Kembali</a>

    <?= form_close(); ?>
</div>
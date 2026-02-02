<div class="container">
    <h2>Tambah Cargo</h2>
    <?= validation_errors(); ?>
    <?= form_open('cargo/add'); ?>

    <div class="form-group">
        <label>Nama Cargo</label>
        <input type="text" name="cargo" class="form-control" onkeyup="capitalizeEachWord(this)">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('cargo') ?>" class="btn btn-secondary">Kembali</a>

    <?= form_close(); ?>
</div>

<script>
    function capitalizeEachWord(input) {
        let words = input.value.toLowerCase().split(' ');
        for (let i = 0; i < words.length; i++) {
            if (words[i].length > 0) {
                words[i] = words[i][0].toUpperCase() + words[i].substr(1);
            }
        }
        input.value = words.join(' ');
    }
</script>
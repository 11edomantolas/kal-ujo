<div class="container">
    <h2>Tambah Angkutan</h2>
    <?= validation_errors(); ?>
    <?= form_open('angkutan/add'); ?>

    <div class="form-group">
        <label>Tipe</label>
        <select name="tipe_angkutan" class="form-control" required>
            <option value="" disabled selected> Pilih Tipe Angkutan </option>
            <?php foreach ($tipe_angkutan as $b): ?>
                <option value="<?= $b['nama_tipe'] ?>" <?= set_select('nama_tipe', $b['nama_tipe']) ?>>
                    <?= $b['nama_tipe'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nomor Polisi</label>
        <input type="text" name="nomor_polisi" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('angkutan') ?>" class="btn btn-secondary">Kembali</a>

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